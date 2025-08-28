<?php

namespace Mpietrucha\Utility;

use Traversable;

class Arr extends \Illuminate\Support\Arr
{
    /**
     * Count the number of elements in the given iterable.
     *
     * @param  iterable<int|string, mixed>  $array
     */
    public static function count(iterable $array): int
    {
        return $array instanceof Traversable ? iterator_count($array) : count($array);
    }

    /**
     * Determine if the given iterable is empty.
     *
     * @param  iterable<int|string, mixed>  $array
     */
    public static function isEmpty(iterable $array): bool
    {
        return static::count($array) === 0;
    }

    /**
     * Determine if the given iterable is not empty.
     *
     * @param  iterable<int|string, mixed>  $array
     */
    final public static function isNotEmpty(iterable $array): bool
    {
        return static::isEmpty($array) |> Normalizer::not(...);
    }

    /**
     * Determine if the given value exists in the provided array.
     *
     * @param  array<int|string, mixed>  $array
     */
    public static function contains(mixed $value, array $array): bool
    {
        return in_array($value, $array);
    }

    /**
     * Determine if the given value doesn`t exists in the provided array.
     *
     * @param  array<int|string, mixed>  $array
     */
    final public static function doesntContain(mixed $value, array $array): bool
    {
        return static::contains($value, $array) |> Normalizer::not(...);
    }
}
