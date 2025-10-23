<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;

abstract class Touch
{
    public static function file(string $path, ?string $directory = null): string
    {
        if (Str::isEmpty($path)) {
            return $path;
        }

        $file = static::build($path, $directory);

        /** @phpstan-ignore-next-line expr.resultUnused */
        Path::directory(...) |> $file->pipe(...) |> static::directory(...);

        return Filesystem::touch(...) |> $file->tap(...) |> static::normalize(...);
    }

    public static function directory(string $path, ?string $directory = null): string
    {
        $directory = static::build($path, $directory);

        return Filesystem::ensureDirectoryExists(...) |> $directory->tap(...) |> static::normalize(...);
    }

    protected static function normalize(string $path): string
    {
        return Path::get($path);
    }

    protected static function build(string $path, ?string $directory = null): Stringable
    {
        return Path::build($path, $directory) |> Str::of(...);
    }
}
