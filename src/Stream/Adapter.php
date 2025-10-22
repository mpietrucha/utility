<?php

namespace Mpietrucha\Utility\Stream;

use Fork\Nyholm\Psr7\Stream;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Type;

class Adapter extends Stream implements AdapterInterface
{
    use Stringable, Wrappable;

    /**
     * @var class-string
     */
    protected static string $wrappable = AdapterInterface::class;

    /**
     * Copy data from the source adapter to the destination adapter and
     * return the number of bytes copied, or null if either stream is detached.
     */
    public function copy(AdapterInterface $source): ?int
    {
        if ($source->isDetached() || $this->isDetached()) {
            return null;
        }

        return @stream_copy_to_stream($source->getResource(), $this->getResource()) ?: null;
    }

    /**
     * Set the blocking mode on the given adapter’s resource and return the
     * operation status, or false if the stream is detached.
     */
    public function await(bool $mode = true): bool
    {
        if ($this->isDetached()) {
            return false;
        }

        return stream_set_blocking($this->getResource(), $mode);
    }

    /**
     * Retrieve the raw stream resource handled by the adapter.
     */
    public function getResource(): mixed
    {
        return $this->stream;
    }

    /**
     * Determine whether the adapter currently holds an attached resource.
     */
    public function isAttached(): bool
    {
        return $this->getResource() |> Type::resource(...);
    }

    /**
     * Determine whether the adapter's resource has been detached.
     */
    public function isDetached(): bool
    {
        return $this->isAttached() |> Normalizer::not(...);
    }

    /**
     * Get the stream URI if the resource is attached, otherwise return null.
     */
    public function getUri(): ?string
    {
        return $this->isAttached() ? parent::getUri() : null;
    }

    /**
     * Get the file path represented by the stream, or null if it is not a file
     * or the file no longer exists.
     */
    public function getFile(): ?string
    {
        $uri = $this->getUri();

        return Type::null($uri) || Filesystem::unexists($uri) ? null : $uri;
    }

    /**
     * Get the entire stream contents as a string.
     */
    public function toString(): string
    {
        return parent::__toString();
    }
}
