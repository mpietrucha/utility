<?php

namespace Mpietrucha\Utility;

use Closure;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Hash\Concerns\Hashable;
use Mpietrucha\Utility\Hash\Contracts\InteractsWithAlgorithmsInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Hash implements InteractsWithAlgorithmsInterface, UtilizableInterface
{
    use Bridgeable, Hashable, Utilizable\Strings {
        Hashable::hash as get;
        Hashable::algorithm as protected default;
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): string
    {
        $value = Arr::first($arguments);

        return static::relay($method)->get($value, $method);
    }

    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? static::utilize();
    }

    public static function bind(?string $algorithm = null): Closure
    {
        return static::{static::algorithm($algorithm)}(...);
    }

    public static function md5(string $value): string
    {
        return md5($value);
    }

    public static function sha1(string $value): string
    {
        return sha1($value);
    }

    public static function sha512(string $value, ?int $variant = null): string
    {
        return static::variant(__FUNCTION__, $value, $variant, '/');
    }

    public static function sha3(string $value, int $variant = 512): string
    {
        return static::variant(__FUNCTION__, $value, $variant, '-');
    }

    public static function tiger128(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function tiger160(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function tiger192(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function gost(string $value, ?string $variant = null): string
    {
        return static::variant(__FUNCTION__, $value, $variant, '-');
    }

    public static function haval128(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function haval160(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function haval192(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function haval224(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    public static function haval256(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, ',');
    }

    protected static function variant(string $algorithm, string $value, null|int|string $variant, string $delimiter): string
    {
        $algorithm = Str::rtrim("$algorithm$delimiter$variant", $delimiter);

        return static::get($algorithm);
    }

    protected static function hydrate(): string
    {
        return static::default();
    }
}
