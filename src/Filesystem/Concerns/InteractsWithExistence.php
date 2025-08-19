<?php

namespace Mpietrucha\Utility\Filesystem\Concerns;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;

/**
 * @internal
 */
trait InteractsWithExistence
{
    /**
     * Determine if the given path exists in the filesystem.
     */
    public static function exists(string $path): bool
    {
        return Filesystem::adapter()->exists($path);
    }

    /**
     * Determine if the given path does not exist in the filesystem.
     */
    public static function unexists(string $path): bool
    {
        return static::exists($path) |> Normalizer::not(...);
    }
}
