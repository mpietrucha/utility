<?php

namespace Mpietrucha\Utility;

abstract class Data
{
    /**
     * Retrieve an item from a nested array or object using "dot" notation.
     *
     * @param  null|int|string|array<array-key, mixed>  $property
     */
    public static function get(mixed $source, null|array|int|string $property, mixed $default = null): mixed
    {
        return data_get($source, $property, $default);
    }

    /**
     * Set a value within a nested array or object using "dot" notation.
     *
     * @param  string|array<array-key, mixed>  $property
     */
    public static function set(mixed &$source, array|string $property, mixed $value, bool $overwrite = true): mixed
    {
        return data_set($source, $property, $value, $overwrite);
    }

    /**
     * Set a value within a nested array or object if it doesn't already exist.
     *
     * @param  string|array<array-key, mixed>  $property
     */
    public static function fill(mixed &$source, array|string $property, mixed $value): mixed
    {
        return data_fill($source, $property, $value);
    }

    /**
     * Remove one or more items from a nested array or object using "dot" notation.
     *
     * @param  null|int|string|array<array-key, mixed>  $property
     */
    public static function forget(mixed &$source, null|array|int|string $property, mixed $value): mixed
    {
        return data_forget($source, $property);
    }
}
