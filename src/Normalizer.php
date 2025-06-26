<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

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
     * Convert the given value to an array using the collection normalizer.
     *
     * @return array<int|string, mixed>
     */
    public static function array(mixed $value): array
    {
        return static::collection($value)->toArray();
    }

    /**
     * Wrap the given value in a collection instance.
     *
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int|string, mixed>
     */
    public static function collection(mixed $value): EnumerableInterface
    {
        return Collection::create($value);
    }
}
