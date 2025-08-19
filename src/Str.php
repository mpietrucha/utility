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

    public static function eol(?string $append = null): string
    {
        return PHP_EOL . $append;
    }

    public static function tab(?string $append = null): string
    {
        return "\t" . $append;
    }

    public static function slash(?string $append = null): string
    {
        return '/' . $append;
    }

    public static function backslash(?string $append = null): string
    {
        return '\\' . $append;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public static function explode(string $string, string $delimiter, ?int $limit = null): EnumerableInterface
    {
        return static::of($string)->explode($delimiter, $limit);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public static function lines(string $string, ?int $limit = null, ?string $delimiter = null): EnumerableInterface
    {
        return static::of($string)->lines($limit, $delimiter);
    }
}
