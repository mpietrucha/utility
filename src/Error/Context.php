<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

abstract class Context
{
    /**
     * @var array<int, string>
     */
    protected static array $consoles = [
        'cli',
        'phpdb',
    ];

    public static function console(): bool
    {
        return Arr::contains(static::consoles(), php_sapi_name());
    }

    final public static function web(): bool
    {
        return static::console() |> Normalizer::not(...);
    }

    /**
     * @return array<int, string>
     */
    protected static function consoles(): array
    {
        return static::$consoles;
    }
}
