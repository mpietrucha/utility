<?php

namespace Mpietrucha\Utility\Filesystem\Temporary;

use Mpietrucha\Utility\Filesystem\Touch;

abstract class Directory
{
    public static function default(): string
    {
        return sys_get_temp_dir();
    }

    public static function name(string $name): string
    {
        return Name::get($name);
    }

    public static function get(string $name): string
    {
        $name = static::name($name);

        return Touch::directory($name, static::default());
    }
}
