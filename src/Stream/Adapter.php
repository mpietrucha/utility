<?php

namespace Mpietrucha\Utility\Stream;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem\File;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Type;
use Nyholm\Psr7\Stream;

final class Adapter extends Stream implements AdapterInterface, CreatableInterface
{
    use Creatable;

    public static function copy(AdapterInterface $source, AdapterInterface $destination): ?int
    {
        if ($source->isDetached() || $destination->isDetached()) {
            return null;
        }

        $pointer = $source->tell();

        return stream_copy_to_stream($source->getResource(), $destination->getResource()) ?: null;
    }

    public static function await(AdapterInterface $adapter, bool $mode = true): bool
    {
        if ($adapter->isDetached()) {
            return false;
        }

        return stream_set_blocking($adapter->getResource(), $mode);
    }

    public function getResource(): mixed
    {
        return $this->resource;
    }

    public function isAttached(): bool
    {
        return Type::resource($this->getResource());
    }

    public function isDetached(): bool
    {
        return Normalizer::not($this->isAttached());
    }

    public function getUri(): ?string
    {
        return $this->isAttached() ? parent::getUri() : null;
    }

    public function getFile(): ?string
    {
        $uri = $this->getUri();

        if (Type::null($uri) || File::unexists($uri)) {
            return null;
        }

        return $uri;
    }

    public function toString(): string
    {
        return (string) $this;
    }
}
