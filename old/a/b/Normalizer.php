<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Illuminate\Collection;

abstract class Normalizer
{
    public static function boolean(mixed $value): bool
    {
        return (bool) $value;
    }

    public static function not(mixed $value): bool
    {
        return self::boolean($value) === false;
    }

    public static function string(mixed $value): string
    {
        return @(string) $value;
    }

    public static function array(mixed $value): array
    {
        return self::collection($value)->toArray();
    }

    public static function collection(mixed $value): Collection
    {
        return Collection::create($value);
    }
}
