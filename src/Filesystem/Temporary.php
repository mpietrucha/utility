<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Str;

abstract class Temporary
{
    public static function flush(string $directory): void
    {
        $files = Extension::unexists(...) |> Finder::uncached()->in($directory)
            ->files()
            ->get()
            ->filter(...);

        $files->each->delete();
    }

    /**
     * @return resource|null
     */
    public static function resource(): mixed
    {
        return tmpfile() ?: null;
    }

    public static function name(): string
    {
        return Str::random(63);
    }

    public static function directory(): string
    {
        return sys_get_temp_dir();
    }

    public static function file(?string $name = null, ?string $directory = null): string
    {
        $directory ??= static::directory();

        $name ??= static::name();

        return @tempnam($directory, $name);
    }
}
