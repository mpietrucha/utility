<?php

namespace Mpietrucha\Utility;

abstract class Value
{
    public static function get(mixed $value, mixed ...$arguments): mixed
    {
        return static::eval($value, $arguments);
    }

    public static function eval(mixed $value, array $arguments): mixed
    {
        return Type::callable($value) ? $value(...$arguments) : $value;
    }
}
