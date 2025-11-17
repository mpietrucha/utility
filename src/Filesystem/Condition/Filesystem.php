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
    public function exists(string $path): bool
    {
        return Adapter::exists($path);
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

    /**
     * Determine if the given path is writable.
     */
    public function writable(string $path): bool
    {
        return Adapter::isWritable($path);
    }

    /**
     * Determine if the given path is readable.
     */
    public function readable(string $path): bool
    {
        return Adapter::isReadable($path);
    }
}
