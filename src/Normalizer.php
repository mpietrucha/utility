<?php

namespace Mpietrucha\Utility;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
abstract class Normalizer
{
    /**
     * Normalize the given value to a boolean.
     */
    public static function boolean(mixed $value): bool
    {
        return (bool) $value;
    }

    /**
     * Determine if the given value is falsy.
     */
    public static function not(mixed $value): bool
    {
        return static::boolean($value) === false;
    }

    /**
     * Normalize the given value to a string.
     */
    public static function string(mixed $value): string
    {
        return @(string) $value;
    }

    /**
     * Normalize the given value to a Stringable instance.
     */
    public static function stringable(mixed $value): Stringable
    {
        return static::string($value) |> Stringable::create(...);
    }

    /**
     * Wrap the given value in a collection instance.
     *
     * @return \Mpietrucha\Utility\Collection<array-key, mixed>
     */
    public static function collection(mixed $value): Collection
    {
        return Collection::wrap($value);
    }

    /**
     * Convert the given value to an array.
     *
     * @return MixedArray
     */
    public static function array(mixed $value): array
    {
        return static::collection($value)->toArray();
    }

    /**
     * Normalize the given value to an integer.
     */
    public static function integer(mixed $value): int
    {
        return Number::integer($value);
    }

    /**
     * Normalize the given value to a float.
     */
    public static function float(mixed $value): float
    {
        return Number::float($value);
    }
}
