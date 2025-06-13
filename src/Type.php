<?php

namespace Mpietrucha\Utility;

abstract class Type
{
    public static function get(mixed $value): string
    {
        return get_debug_type($value);
    }

    public static function null(mixed $value): bool
    {
        return is_null($value);
    }

    public static function boolean(mixed $value): bool
    {
        return is_bool($value);
    }

    public static function integer(mixed $value): bool
    {
        return is_int($value);
    }

    public static function float(mixed $value): bool
    {
        return is_float($value);
    }

    public static function numeric(mixed $value): bool
    {
        return is_numeric($value);
    }

    public static function string(mixed $value): bool
    {
        return is_string($value);
    }

    public static function array(mixed $value): bool
    {
        return is_array($value);
    }

    public static function resource(mixed $value): bool
    {
        return is_resource($value);
    }

    public static function object(mixed $value): bool
    {
        return is_object($value);
    }

    public static function scalar(mixed $value): bool
    {
        return is_scalar($value);
    }

    public static function callable(mixed $value): bool
    {
        return is_callable($value);
    }

    public static function countable(mixed $value): bool
    {
        return is_countable($value);
    }

    public static function iterable(mixed $value): bool
    {
        return is_iterable($value);
    }

    public static function file(mixed $value)
    {
        return static::string($value) && is_file($value);
    }
}
