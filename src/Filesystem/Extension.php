<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithExistence;
use Symfony\Component\Filesystem\Path;

abstract class Extension
{
    use InteractsWithExistence;

    /**
     * Determine if the given path has a file extension.
     */
    public static function exists(string $path): bool
    {
        return Path::hasExtension($path);
    }

    /**
     * Get the file extension from the given path,
     * or null if the path does not have an extension.
     */
    public static function get(string $path): ?string
    {
        if (static::unexists($path)) {
            return null;
        }

        return Path::getExtension($path);
    }

    /**
     * Change or set the file extension for the given path.
     */
    public static function set(string $path, string $extension): string
    {
        return Path::changeExtension($path, $extension);
    }
}
