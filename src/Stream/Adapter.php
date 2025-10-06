<?php

namespace Mpietrucha\Utility\Stream;

use Fork\Nyholm\Psr7\Stream;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Type;

/**
 * @method static \Mpietrucha\Utility\Stream\Contracts\AdapterInterface build(mixed $body)
 */
class Adapter extends Stream implements AdapterInterface, CreatableInterface
{
    use Creatable, Stringable;

    /**
     * Copy data from the source adapter to the destination adapter and
     * return the number of bytes copied, or null if either stream is detached.
     */
    public static function copy(AdapterInterface $source, AdapterInterface $destination): ?int
    {
        if ($source->isDetached() || $destination->isDetached()) {
            return null;
        }

        return @stream_copy_to_stream($source->getResource(), $destination->getResource()) ?: null;
    }

    /**
     * Set the blocking mode on the given adapter’s resource and return the
     * operation status, or false if the stream is detached.
     */
    public static function await(AdapterInterface $adapter, bool $mode = true): bool
    {
        if ($adapter->isDetached()) {
            return false;
        }

        return stream_set_blocking($adapter->getResource(), $mode);
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
