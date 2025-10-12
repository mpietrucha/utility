<?php

namespace Mpietrucha\Utility\Instance\Serializer;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Error\Level;
use Mpietrucha\Utility\Value;

class Native
{
    public static function serialize(object $data): string
    {
        return static::pipe(serialize(...), $data);
    }

    public static function unserialize(string $data): object
    {
        return static::pipe(unserialize(...), $data);
    }

    /**
     * @return ($value is string ? object : string)
     */
    protected static function pipe(callable $callback, object|string $value): object|string
    {
        $value = Arr::wrap($value);

        return Level::supress(Level::DEPRECATED, Value::bind($callback, $value));
    }
}
