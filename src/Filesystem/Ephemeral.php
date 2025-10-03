<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;

abstract class Ephemeral
{
    protected static ?string $storage = null;

    public static function use(string $storage): void
    {
        static::$storage = $storage;
    }

    public static function storage(): string
    {
        return static::$storage ??= Touch::directory('ephemerals', sys_get_temp_dir());
    }

    public static function flush(): void
    {
        static::storage() |> Filesystem::deleteDirectory(...);
    }

    public static function get(?string $name = null): string
    {
        $name ??= Str::random(64);

        return @tempnam(static::storage(), $name);
    }
}
