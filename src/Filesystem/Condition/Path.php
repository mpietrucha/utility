<?php

namespace Mpietrucha\Utility\Filesystem\Condition;

use Mpietrucha\Utility\Filesystem\Condition;
use Symfony\Component\Filesystem\Path as Adapter;

class Path extends Condition
{
    /**
     * Determine if the given path is absolute.
     */
    public function absolute(string $path): bool
    {
        return Adapter::isAbsolute($path);
    }

    /**
     * Determine if the given path is relative.
     */
    public function relative(string $path): bool
    {
        return Adapter::isRelative($path);
    }

    /**
     * Determine if the given path is local.
     */
    public function local(string $path): bool
    {
        return Adapter::isLocal($path);
    }

    /**
     * Determine if the given path is a base path of another given path.
     */
    public function base(string $path, string $of): bool
    {
        return Adapter::isBasePath($path, $of);
    }
}
