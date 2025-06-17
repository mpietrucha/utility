<?php

namespace Mpietrucha\Utility;

abstract class Data
{
    public static function get(mixed $source, null|int|string|array $property, mixed $default = null): mixed
    {
        return data_get($source, $property, $default);
    }

    public static function set(mixed &$source, string|array $property, mixed $value, bool $overwrite = true): mixed
    {
        return data_set($source, $property, $value, $overwrite);
    }

    public static function fill(mixed &$source, string|array $property, mixed $value): mixed
    {
        return data_fill($source, $property, $value);
    }

    public static function forget(mixed &$source, null|int|string|array $property, mixed $value): mixed
    {
        return data_forget($source, $property);
    }
}
