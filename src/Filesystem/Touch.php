<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;

abstract class Touch
{
    /**
     * Touch a file to create it if it doesn't exist.
     */
    public static function file(string $path, ?string $directory = null): string
    {
        if (Str::isEmpty($path)) {
            return $path;
        }

        $file = static::build($path, $directory);

        Path::directory(...) |> $file->pipe(...) |> static::directory(...);

        return Filesystem::touch(...) |> $file->tap(...) |> static::normalize(...);
    }

    /**
     * Create a directory if it doesn't exist.
     */
    public static function directory(string $path, ?string $directory = null): string
    {
        $directory = static::build($path, $directory);

        return Filesystem::ensureDirectoryExists(...) |> $directory->tap(...) |> static::normalize(...);
    }

    /**
     * Normalize the path to its canonical form.
     */
    protected static function normalize(string $path): string
    {
        return Path::get($path);
    }

    /**
     * Build a stringable path from the given path and directory.
     */
    protected static function build(string $path, ?string $directory = null): Stringable
    {
        return Path::build($path, $directory) |> Str::of(...);
    }
}
