<?php

namespace Mpietrucha\Utility\Illuminate;

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
     * Format a string using the given arguments.
     */
    public static function sprintf(string $string, null|float|int|string ...$arguments): string
    {
        return sprintf($string, ...$arguments);
    }
}
