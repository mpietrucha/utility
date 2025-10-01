<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Error\Contracts\InteractsWithLevelsInterface;

abstract class Level implements InteractsWithLevelsInterface
{
    public static function use(?int $level = null): int
    {
        return error_reporting($level);
    }

    public static function set(int $level): int
    {
        return static::use($level);
    }

    public static function get(): int
    {
        return static::use();
    }
}
