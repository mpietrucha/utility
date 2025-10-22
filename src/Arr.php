<?php

namespace Mpietrucha\Utility;

use Traversable;

class Arr extends \Illuminate\Support\Arr
{
    /**
     * Count the number of elements in the given iterable.
     *
     * @param  iterable<array-key, mixed>  $array
     */
    public static function count(iterable $array): int
    {
        return $array instanceof Traversable ? iterator_count($array) : count($array);
    }

    /**
     * Determine if the given iterable is empty.
     *
     * @param  iterable<array-key, mixed>  $array
     */
    public static function isEmpty(iterable $array): bool
    {
        return static::count($array) === 0;
    }

    /**
     * Determine if the given iterable is not empty.
     *
     * @param  iterable<array-key, mixed>  $array
     */
    final public static function isNotEmpty(iterable $array): bool
    {
        return static::isEmpty($array) |> Normalizer::not(...);
    }

    /**
     * Determine if the given value exists in the provided array.
     *
     * @param  array<array-key, mixed>  $array
     */
    public static function contains(array $array, mixed $value): bool
    {
        return in_array($value, $array);
    }

    /**
     * Determine if the given value doesn`t exists in the provided array.
     *
     * @param  array<array-key, mixed>  $array
     */
    final public static function doesntContain(array $array, mixed $value): bool
    {
        return static::contains($array, $value) |> Normalizer::not(...);
    }

    /**
     * @template TValue
     *
     * @param  TValue  $value
     * @return list<TValue>
     */
    public static function overlap(mixed $value): array
    {
        return [$value];
    }

    /**
     * @param  array<array-key,  mixed>  $array
     * @return array<array-key,  mixed>
     */
    public static function slice(array $array, int $offset, ?int $length = null): array
    {
        return array_slice($array, $offset, $length);
    }

    /**
     * @param  array<array-key, mixed>  $array
     * @return array<array-key, mixed>
     */
    public static function skip(array $array, int $count): array
    {
        return static::slice($array, $count);
    }

    /**
     * @template TValue
     *
     * @param  array<array-key, TValue>  $array
     * @return list<TValue>
     */
    public static function values(array $array): array
    {
        return array_values($array);
    }

    /**
     * @template TKey of array-key
     * @template TValue
     *
     * @param  array<TKey, TValue>  $array
     * @param  TValue  $value
     * @param  TKey|null  $key
     * @return array<TKey, TValue>
     */
    public static function append(array $array, mixed $value, null|int|string $key = null): array
    {
        if (Type::not()->null($key)) {
            return [$key => $value] + $array;
        }

        array_push($array, $value);

        return $array;
    }

    /**
     * @template TKey of array-key
     * @template TValue
     *
     * @param  array<TKey, TValue>  $array
     * @return array<TValue, TKey>
     */
    public static function flip(array $array): array
    {
        return array_flip($array);
    }

    /**
     * @template TKey of array-key
     *
     * @param  array<TKey, mixed>  $array
     * @return TKey|null
     */
    public static function search(array $array, mixed $search, bool $strict = false): null|int|string
    {
        return array_search($array, $search, $strict) ?: null;
    }
}
