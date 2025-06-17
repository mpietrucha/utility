<?php

namespace Mpietrucha\Utility\Illuminate;

class Str extends \Illuminate\Support\Str
{
    public static function of(mixed $string): Stringable
    {
        return Stringable::create($string);
    }

    public static function sprintf(string $string, array $arguments): string
    {
        return sprintf($string, ...$arguments);
    }
}
