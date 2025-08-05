<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

class Str extends \Illuminate\Support\Str
{
    /**
     * Create a new stringable instance from the given value.
     */
    public static function of(mixed $string): Stringable
    {
        return Stringable::create($string);
    }

    /**
     * Determine if the given string is empty.
     */
    public static function isEmpty(string $string): bool
    {
        return static::of($string)->isEmpty();
    }

    /**
     * Determine if the given string is not empty.
     */
    final public static function isNotEmpty(string $string): bool
    {
        return static::isEmpty($string) |> Normalizer::not(...);
    }

    /**
     * Format a string using the given arguments.
     */
    public static function sprintf(string $string, null|float|int|string ...$arguments): string
    {
        return sprintf($string, ...$arguments);
    }

    public static function eol(?string $string = null): string
    {
        return $string . PHP_EOL;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public static function explode(string $string, string $delimiter, int $limit = PHP_INT_MAX): EnumerableInterface
    {
        return explode($delimiter, $string, $limit) |> Collection::create(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public static function lines(string $string, string $delimiter = PHP_EOL, int $limit = PHP_INT_MAX): EnumerableInterface
    {
        return static::explode($string, $delimiter, $limit);
    }
}
