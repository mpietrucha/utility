<?php

namespace Mpietrucha\Utility;

abstract class Number extends \Illuminate\Support\Number
{
    public static function integer(mixed $value): int
    {
        if (Type::integer($value)) {
            return $value;
        }

        return Normalizer::string($value) |> static::parseInt(...);
    }

    public static function float(mixed $value): float
    {
        if (Type::float($value)) {
            return $value;
        }

        return Normalizer::string($value) |> static::parseFloat(...);
    }
}
