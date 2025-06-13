<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Stream\Adapter;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

class Stream implements CreatableInterface, StreamInterface, TappableInterface
{
    use Creatable, Stringable, Tappable;

    protected ?int $bytes = null;

    protected ?AdapterInterface $adapter = null;

    public function __construct(protected mixed $input, bool $bootstrap = true)
    {
        $bootstrap && $this->adapter();
    }

    public function __destruct()
    {
        $this->close();
    }

    public static function open(string $uri, string $mode): self
    {
        $handler = fopen($uri, $mode);

        return static::create($handler);
    }

    public static function temporary(): self
    {
        return static::open('php://temporary', 'r+');
    }

    public static function input(): self
    {
        return static::create(STDIN);
    }

    public static function output(): self
    {
        return static::create(STDOUT);
    }

    public function adapter(): AdapterInterface
    {
        return $this->adapter ??= Adapter::build($this->input());
    }

    public function resource(): mixed
    {
        return $this->adapter()->getResource();
    }

    public function attached(): bool
    {
        return $this->adapter()->isAttached();
    }

    public function detached(): bool
    {
        return $this->adapter()->isDetached();
    }

    public function uri(): ?string
    {
        return $this->adapter()->getUri();
    }

    public function file(): ?string
    {
        return $this->adapter()->getFile();
    }

    public function await(bool $mode = true): self
    {
        Adapter::await($this->handler(), $mode);

        return $this;
    }

    final public function unleash(bool $mode = true): self
    {
        return $this->await(Normalizer::not($mode));
    }

    public function close(): void
    {
        $this->adapter()->close();
    }

    public function detach(): mixed
    {
        return $this->adapter()->detach();
    }

    public function size(): ?int
    {
        return $this->adapter()->getSize();
    }

    public function tell(): int
    {
        return $this->adapter()->tell();
    }

    public function eof(): bool
    {
        return $this->adapter()->eof();
    }

    public function seekable(): bool
    {
        return $this->adapter()->isSeekable();
    }

    public function seek(int $pointer, int $mode = SEEK_SET): self
    {
        $this->adapter()->seek($pointer, $mode);

        return $this;
    }

    public function rewind(): self
    {
        $this->adapter()->rewind();

        return $this;
    }

    public function restore(?int $pointer = null, int $mode = SEEK_SET): self
    {
        if ($this->seekable() === false) {
            return $this;
        }

        if (Type::null($pointer)) {
            return $this->rewind();
        }

        return $this->seek($pointer, $mode);
    }

    public function writable(): bool
    {
        return $this->adapter()->isWritable();
    }

    public function copy(StreamInterface $source): self
    {
        $source->paste($source);

        return $this;
    }

    public function paste(StreamInterface $destination): self
    {
        $bytes = Adapter::copy($this->adapter(), $destination->adapter());

        if (Type::integer($bytes)) {
            return $this->record($bytes);
        }

        return $this->write($destination->contents());
    }

    public function write(StreamInterface|string $contents): self
    {
        if ($contents instanceof StreamInterface) {
            return $this->paste($contents);
        }

        return $this->record($this->adapter()->write($contents));
    }

    public function set(StreamInterface|string $contents): self
    {
        return $this->restore()->write($contents);
    }

    public function bytes(): ?int
    {
        return $this->bytes;
    }

    public function readable(): bool
    {
        return $this->adapter()->isReadable();
    }

    public function read(int $length): string
    {
        return $this->adapter()->read($length);
    }

    public function contents(): string
    {
        return $this->adapter()->getContents();
    }

    public function toString(): string
    {
        return $this->adapter()->toString();
    }

    public function get(): string
    {
        $pointer = $this->tell();

        $response = $this->toString();

        return $this->tap($response)->restore($pointer);
    }

    protected function input(): mixed
    {
        return $this->input;
    }

    protected function record(int $bytes): self
    {
        $this->bytes = $bytes;

        return $this;
    }
}
