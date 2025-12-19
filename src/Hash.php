<?php

namespace Mpietrucha\Utility;

use Closure;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Hash\Concerns\Hashable;
use Mpietrucha\Utility\Hash\Contracts\InteractsWithAlgorithmsInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
abstract class Hash implements InteractsWithAlgorithmsInterface, UtilizableInterface
{
    use Bridgeable, Hashable, Utilizable\Strings {
        Hashable::hash as get;
        Hashable::algorithm as protected default;
    }

    /**
     * Dynamically handle static method calls to hash algorithms.
     *
     * @param  MixedArray  $arguments
     */
    public static function __callStatic(string $method, array $arguments): string
    {
        $value = Arr::first($arguments);

        return static::relay($method)->get($value, $method);
    }

    /**
     * Get the hash algorithm to use, defaulting to the utilized algorithm.
     */
    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? static::utilize();
    }

    /**
     * Create a closure bound to a specific hash algorithm.
     */
    public static function bind(?string $algorithm = null): Closure
    {
        return static::{static::algorithm($algorithm)}(...);
    }

    /**
     * Generate an MD5 hash of the given value.
     */
    public static function md5(string $value): string
    {
        return md5($value);
    }

    /**
     * Generate a SHA1 hash of the given value.
     */
    public static function sha1(string $value): string
    {
        return sha1($value);
    }

    /**
     * Generate a SHA512 hash of the given value with optional variant.
     */
    public static function sha512(string $value, ?int $variant = null): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::slash());
    }

    /**
     * Generate a SHA3 hash of the given value with the specified variant.
     */
    public static function sha3(string $value, int $variant = 512): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::dash());
    }

    /**
     * Generate a Tiger128 hash of the given value with the specified variant.
     */
    public static function tiger128(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a Tiger160 hash of the given value with the specified variant.
     */
    public static function tiger160(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a Tiger192 hash of the given value with the specified variant.
     */
    public static function tiger192(string $value, int $variant = 4): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a GOST hash of the given value with optional variant.
     */
    public static function gost(string $value, ?string $variant = null): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::dash());
    }

    /**
     * Generate a HAVAL128 hash of the given value with the specified variant.
     */
    public static function haval128(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a HAVAL160 hash of the given value with the specified variant.
     */
    public static function haval160(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a HAVAL192 hash of the given value with the specified variant.
     */
    public static function haval192(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a HAVAL224 hash of the given value with the specified variant.
     */
    public static function haval224(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a HAVAL256 hash of the given value with the specified variant.
     */
    public static function haval256(string $value, int $variant = 5): string
    {
        return static::variant(__FUNCTION__, $value, $variant, Str::comma());
    }

    /**
     * Generate a hash using the specified algorithm and variant.
     */
    protected static function variant(string $algorithm, string $value, null|int|string $variant, string $delimiter): string
    {
        $algorithm = Str::rtrim("$algorithm$delimiter$variant", $delimiter);

        return static::get($algorithm);
    }

    /**
     * Get the default hash algorithm for hydration.
     */
    protected static function hydrate(): string
    {
        return static::default();
    }
}
