<?php

namespace Mpietrucha\Utility\Stream;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Type;
use Nyholm\Psr7\Stream;

/**
 * @method static \Mpietrucha\Utility\Stream\Contracts\AdapterInterface build(mixed $body)
 */
class Adapter extends Stream implements AdapterInterface, CreatableInterface
{
    use Creatable;

    /**
     * Copy data from the source adapter to the destination adapter and
     * return the number of bytes copied, or null if either stream is detached.
     */
    public static function copy(AdapterInterface $source, AdapterInterface $destination): ?int
    {
        if ($source->isDetached() || $destination->isDetached()) {
            return null;
        }

        $pointer = $source->tell();

        return stream_copy_to_stream($source->getResource(), $destination->getResource()) ?: null;
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
        return Type::resource($this->getResource());
    }

    /**
     * Determine whether the adapter's resource has been detached.
     */
    public function isDetached(): bool
    {
        return Normalizer::not($this->isAttached());
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

        if (Type::null($uri) || Filesystem::unexists($uri)) {
            return null;
        }

        return $uri;
    }

    /**
     * Get the entire stream contents as a string.
     */
    public function toString(): string
    {
        return (string) $this;
    }
}
