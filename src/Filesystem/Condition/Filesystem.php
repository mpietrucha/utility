<?php

namespace Mpietrucha\Utility\Filesystem\Condition;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem as Adapter;

class Filesystem implements CreatableInterface
{
    use Creatable;

    /**
     * Determine if the given path exists as a file or directory.
     */
    public function present(string $path): bool
    {
        return $this->file($path) || $this->directory($path);
    }

    /**
     * Determine if the given path exists and is a file.
     */
    public function file(string $path): bool
    {
        return Adapter::isFile($path);
    }

    /**
     * Determine if the given path exists and is a directory.
     */
    public function directory(string $path): bool
    {
        return Adapter::isDirectory($path);
    }

    public function writable(string $path): bool
    {
        return Adapter::isWritable($path);
    }

    public function readable(string $path): bool
    {
        return Adapter::isReadable($path);
    }
}
