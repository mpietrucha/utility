<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Error\Contracts\InteractsWithLevelsInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

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

    public static function add(int $level): int
    {
        return static::set(static::get() | $level);
    }

    public static function suspend(int $level): int
    {
        return static::set(static::get() ^ $level);
    }

    public static function supress(int $level, callable $callback): mixed
    {
        if (static::unexists($level)) {
            return Value::for($callback)->get();
        }

        static::suspend($level);

        $response = static::supress($level, $callback);

        static::add($level);

        return $response;
    }

    public static function exists(int $level): bool
    {
        return Normalizer::boolean(static::get() & $level);
    }

    final public static function unexists(int $level): bool
    {
        return static::exists($level) |> Normalizer::not(...);
    }
}
