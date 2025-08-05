<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Backtrace;
use Mpietrucha\Utility\Filesystem;

abstract class Cache
{
    public static function name(): string
    {
        return '.cache';
    }

    public static function directory(?string $name = null, ?string $base = null, int $level = 2): string
    {
        $base ??= Backtrace::get()->last()->file();

        $name ??= static::name();

        $directory = Path::absolute($name, Path::directory($base, $level));

        Filesystem::ensureDirectoryExists($directory);

        return $directory;
    }
}
