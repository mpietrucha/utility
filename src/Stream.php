<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Passable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PassableInterface;
use Mpietrucha\Utility\Forward\Context;
use Mpietrucha\Utility\Forward\Contracts\ContextInterface;
use Mpietrucha\Utility\Stream\Adapter;
use Mpietrucha\Utility\Stream\Concerns\InteractsWithFilesystem;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

class Stream implements CreatableInterface, PassableInterface, StreamInterface
{
    use Creatable, InteractsWithFilesystem, Passable, Stringable;

    protected ?int $bytes = null;

    /**
     * Create a new stream instance with the given body and optionally bootstrap it.
     */
    public function __construct(protected mixed $body, protected ?AdapterInterface $adapter = null)
    {
        $this->adapter();
    }

    /**
     * Close the stream on destruction.
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Create a stream from standard input.
     */
    public static function input(): static
    {
        return static::create(STDIN);
    }

    /**
     * Create a stream from standard output.
     */
    public static function output(): static
    {
        return static::create(STDOUT);
    }

    /**
     * Create a forward context that negates selected stream capabilities.
     */
    public function not(): ContextInterface
    {
        $methods = Context::allow([
            'seekable',
            'writable',
        ]);

        return Context::not($this, $methods);
    }

    /**
     * Get the underlying stream adapter instance.
     */
    public function adapter(): AdapterInterface
    {
        return $this->adapter ??= $this->body() |> Adapter::build(...);
    }

    /**
     * Get the raw resource associated with the stream.
     */
    public function resource(): mixed
    {
        return $this->adapter()->getResource();
    }

    /**
     * Determine if the stream resource is attached.
     */
    public function attached(): bool
    {
        return $this->adapter()->isAttached();
    }

    /**
     * Determine if the stream resource is detached.
     */
    public function detached(): bool
    {
        return $this->adapter()->isDetached();
    }

    /**
     * Get the stream's URI if available.
     */
    public function uri(): ?string
    {
        return $this->adapter()->getUri();
    }

    /**
     * Get the file path associated with the stream if available.
     */
    public function file(): ?string
    {
        return $this->adapter()->getFile();
    }

    /**
     * Set the stream's blocking mode using the underlying adapter.
     */
    public function await(bool $mode = true): static
    {
        Adapter::await($this->adapter(), $mode);

        return $this;
    }

    /**
     * Reverse the blocking mode on the underlying stream adapter.
     */
    final public function unleash(bool $mode = true): static
    {
        return Normalizer::not($mode) |> $this->await(...);
    }

    /**
     * Close the stream resource.
     */
    public function close(): void
    {
        $this->adapter()->close();
    }

    /**
     * Detach the stream resource.
     */
    public function detach(): mixed
    {
        return $this->adapter()->detach();
    }

    /**
     * Get the size of the stream if known.
     */
    public function size(): ?int
    {
        return $this->adapter()->getSize();
    }

    /**
     * Get the current position of the stream pointer.
     */
    public function tell(): int
    {
        return $this->adapter()->tell();
    }

    /**
     * Determine if the end of the stream has been reached.
     */
    public function eof(): bool
    {
        return $this->adapter()->eof();
    }

    /**
     * Determine if the stream is seekable.
     */
    public function seekable(): bool
    {
        return $this->adapter()->isSeekable();
    }

    /**
     * Move the stream pointer to a specific position.
     */
    public function seek(int $pointer, int $mode = SEEK_SET): static
    {
        $this->adapter()->seek($pointer, $mode);

        return $this;
    }

    /**
     * Rewind the stream pointer to the beginning.
     */
    public function rewind(): static
    {
        $this->adapter()->rewind();

        return $this;
    }

    /**
     * Restore the stream pointer to a specific position or rewind it.
     */
    public function restore(?int $pointer = null, int $mode = SEEK_SET): static
    {
        if ($this->not()->seekable()) {
            return $this;
        }

        if (Type::null($pointer)) {
            return $this->rewind();
        }

        return $this->seek($pointer, $mode);
    }

    /**
     * Determine if the stream is writable.
     */
    public function writable(): bool
    {
        return $this->adapter()->isWritable();
    }

    /**
     * Copy contents from the source stream into this stream using the adapter's resource.
     */
    public function copy(StreamInterface $detination): static
    {
        $detination->paste($this);

        return $this;
    }

    /**
     * Transfer contents from this stream into the destination stream.
     */
    public function paste(StreamInterface $source): static
    {
        $bytes = Adapter::copy($source->adapter(), $this->adapter());

        if (Type::integer($bytes)) {
            return $this->record($bytes);
        }

        return $source->contents() |> $this->write(...);
    }

    /**
     * Write the given contents or stream to this stream using the adapter.
     */
    public function write(StreamInterface|string $contents): static
    {
        if ($contents instanceof StreamInterface) {
            return $this->paste($contents);
        }

        return $this->adapter()->write($contents) |> $this->record(...);
    }

    /**
     * Overwrite the stream contents with the given data.
     */
    public function set(StreamInterface|string $contents): static
    {
        return $this->restore()->write($contents);
    }

    /**
     * Get the number of bytes written to the stream.
     */
    public function bytes(): ?int
    {
        return $this->bytes;
    }

    /**
     * Determine if the stream is readable.
     */
    public function readable(): bool
    {
        return $this->adapter()->isReadable();
    }

    /**
     * Read a specific number of bytes from the stream.
     */
    public function read(int $length): string
    {
        return $this->adapter()->read($length);
    }

    /**
     * Read the remaining contents of the stream.
     */
    public function contents(): string
    {
        return $this->adapter()->getContents();
    }

    /**
     * Get the stream contents as a string.
     */
    public function toString(): string
    {
        return $this->adapter()->toString();
    }

    /**
     * Get the stream contents while preserving the current pointer.
     */
    public function get(): string
    {
        $response = $this->toString();

        if ($this->not()->seekable()) {
            return $response;
        }

        return $this->tell() |> $this->pass($response)->restore(...);
    }

    /**
     * Get the raw body value used to create the stream.
     */
    protected function body(): mixed
    {
        return $this->body;
    }

    /**
     * Store the number of bytes written to the stream.
     */
    protected function record(int $bytes): static
    {
        $this->bytes = $bytes;

        return $this;
    }
}
