<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-import-type MixedIterable from \Mpietrucha\Utility\Arr
 */
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

    /**
     * @param  MixedIterable|float|int  $numbers
     * @return \Mpietrucha\Utility\Collection<int, int|float>
     */
    public static function collection(float|int|iterable ...$numbers): EnumerableInterface
    {
        return Collection::create($numbers)
            ->flatten()
            ->whereType([Type::FLOAT, Type::INTEGER]);
    }

    /**
     * @param  MixedIterable|float|int  $numbers
     */
    public static function min(float|int|iterable ...$numbers): null|float|int
    {
        return static::collection($numbers)->min();
    }

    /**
     * @param  MixedIterable|float|int  $numbers
     */
    public static function max(float|int|iterable ...$numbers): null|float|int
    {
        return static::collection($numbers)->max();
    }

    /**
     * Get the absolute value of the given number.
     */
    public static function abs(float|int $number): float|int
    {
        return abs($number);
    }
}
