<?php

namespace Mpietrucha\Utility;

abstract class Context
{
    /**
     * @var list<string>
     */
    protected static array $consoles = [
        'cli',
        'phpdb',
    ];

    /**
     * Determine if the current environment is a console/CLI context.
     */
    public static function console(): bool
    {
        return Arr::contains(static::consoles(), php_sapi_name());
    }

    /**
     * Determine if the current environment is a web context.
     */
    final public static function web(): bool
    {
        return static::console() |> Normalizer::not(...);
    }

    /**
     * Get the list of console SAPI names.
     *
     * @return list<string>
     */
    protected static function consoles(): array
    {
        return static::$consoles;
    }
}
