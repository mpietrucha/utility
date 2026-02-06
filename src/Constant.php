<?php

namespace Mpietrucha\Utility;

abstract class Constant
{
    public static function defined(string $constant): bool
    {
        return defined($constant);
    }

    final public static function undefined(string $constant): bool
    {
        return static::defined($constant) |> Normalizer::not(...);
    }
}
