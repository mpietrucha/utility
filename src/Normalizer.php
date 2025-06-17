<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

abstract class Normalizer
{
    public static function boolean(mixed $value): bool
    {
        return (bool) $value;
    }

    public static function not(mixed $value): bool
    {
        return static::boolean($value) === false;
    }

    public static function string(mixed $value): string
    {
        return @(string) $value;
    }

    /**
        @return array<mixed>
     */
    public static function array(mixed $value): array
    {
        return static::collection($value)->toArray();
    }

    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, mixed>
     */
    public static function collection(mixed $value): EnumerableInterface
    {
        return Collection::create($value);
    }
}
