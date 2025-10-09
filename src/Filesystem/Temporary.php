<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Str;

abstract class Temporary
{
    public static function file(): mixed
    {
        return tmpfile() ?: null;
    }

    public static function directory(): string
    {
        return sys_get_temp_dir();
    }

    public static function name(string $directory, ?string $name = null): string
    {
        return @tempnam($directory, $name ?? Str::random(63));
    }
}
