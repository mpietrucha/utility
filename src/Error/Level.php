<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Error\Contracts\InteractsWithLevelsInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

abstract class Level implements InteractsWithLevelsInterface
{
    /**
     * Set or get the current error reporting level.
     */
    public static function use(?int $level = null): int
    {
        return error_reporting($level);
    }

    /**
     * Set the error reporting level.
     */
    public static function set(int $level): int
    {
        return static::use($level);
    }

    /**
     * Get the current error reporting level.
     */
    public static function get(): int
    {
        return static::use();
    }

    /**
     * Add an error level to the current reporting level.
     */
    public static function add(int $level): int
    {
        return static::set(static::get() | $level);
    }

    /**
     * Suspend an error level from the current reporting level.
     */
    public static function suspend(int $level): int
    {
        return static::set(static::get() ^ $level);
    }

    /**
     * Suppress an error level while executing the callback.
     */
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

    /**
     * Determine if the given error level exists in the current reporting level.
     */
    public static function exists(int $level): bool
    {
        return Normalizer::boolean(static::get() & $level);
    }

    /**
     * Determine if the given error level does not exist in the current reporting level.
     */
    final public static function unexists(int $level): bool
    {
        return static::exists($level) |> Normalizer::not(...);
    }
}
