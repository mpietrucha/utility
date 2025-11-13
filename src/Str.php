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
     * Get the string or null when string is empty.
     */
    public static function nullWhenEmpty(string $string): ?string
    {
        return match (true) {
            static::isEmpty($string) => null,
            default => $string
        };
    }

    /**
     * Generate a hash of the given string using the specified algorithm.
     */
    public static function hash(string $string, ?string $algorithm = null): string
    {
        return static::of($string)->hash($algorithm);
    }

    /**
     * Format a string using the given arguments.
     */
    public static function sprintf(string $string, mixed ...$arguments): string
    {
        return sprintf($string, ...$arguments);
    }

    /**
     * Get the end-of-line character with an optional appended string.
     */
    public static function eol(?string $append = null): string
    {
        return PHP_EOL . $append;
    }

    /**
     * Get an empty string with an optional appended string.
     */
    public static function none(?string $append = null): string
    {
        return '' . $append;
    }

    /**
     * Get a tab character with an optional appended string.
     */
    public static function tab(?string $append = null): string
    {
        return "\t" . $append;
    }

    /**
     * Get a forward slash with an optional appended string.
     */
    public static function slash(?string $append = null): string
    {
        return '/' . $append;
    }

    /**
     * Get a backslash with an optional appended string.
     */
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
