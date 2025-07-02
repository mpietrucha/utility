<?php

namespace Mpietrucha\Utility;

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
        return Normalizer::not(static::isEmpty($string));
    }

    /**
     * Format a string using the given arguments.
     */
    public static function sprintf(string $string, null|float|int|string ...$arguments): string
    {
        return sprintf($string, ...$arguments);
    }
}
