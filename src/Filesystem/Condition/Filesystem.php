<?php

namespace Mpietrucha\Utility\Filesystem\Condition;

use Mpietrucha\Utility\Filesystem as Adapter;
use Mpietrucha\Utility\Filesystem\Condition;

class Filesystem extends Condition
{
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
}
