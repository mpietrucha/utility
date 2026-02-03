<?php

namespace Mpietrucha\Utility\Instance\Serializer;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Error\Level;
use Mpietrucha\Utility\Value;

class Native
{
    /**
     * Serialize an object using PHP's native serialize function.
     */
    public static function serialize(object $data): string
    {
        return static::pipe(serialize(...), $data);
    }

    /**
     * Unserialize a string using PHP's native unserialize function.
     */
    public static function unserialize(string $data): object
    {
        return static::pipe(unserialize(...), $data);
    }

    /**
     * Execute the callback with error suppression for deprecated warnings.
     *
     * @return ($value is string ? object : string)
     */
    protected static function pipe(callable $callback, object|string $value): object|string
    {
        $value = Arr::wrap($value);

        return Level::supress(Level::DEPRECATED, Value::bind($callback, $value));
    }
}
