<?php

namespace Mpietrucha\Utility;

abstract class Number extends \Illuminate\Support\Number
{
    /**
     * Parse the given value as an integer using the specified locale.
     */
    public static function integer(mixed $value, ?string $locale = null): int
    {
        if (Type::integer($value)) {
            return $value;
        }

        /** @phpstan-ignore-next-line return.type */
        return static::parseInt(Normalizer::string($value), $locale);
    }

    /**
     * Parse the given value as a float using the specified locale.
     */
    public static function float(mixed $value, ?string $locale = null): float
    {
        if (Type::float($value)) {
            return $value;
        }

        /** @phpstan-ignore-next-line return.type */
        return static::parseFloat(Normalizer::string($value), $locale);
    }
}
