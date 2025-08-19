<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;

abstract class Touch
{
    public static function file(string $path, ?string $base = null): string
    {
        Filesystem::touch($file = static::build($path, $base));

        return $file;
    }

    public static function directory(string $path, ?string $base = null): string
    {
        Filesystem::ensureDirectoryExists($directory = static::build($path, $base));

        return $directory;
    }

    protected static function build(string $path, ?string $base): string
    {
        return Path::build($path, $base);
    }
}
