<?php

namespace Mpietrucha\Utility;

use Closure;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Hash\Exception\HashException;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

/**
 * @method static string md2(string $value)
 * @method static string md4(string $value)
 * @method static string sha224(string $value)
 * @method static string sha256(string $value)
 * @method static string sha384(string $value)
 * @method static string ripemd128(string $value)
 * @method static string ripemd160(string $value)
 * @method static string ripemd256(string $value)
 * @method static string ripemd320(string $value)
 * @method static string whirlpool(string $value)
 * @method static string snefru(string $value)
 * @method static string snefru256(string $value)
 * @method static string adler32(string $value)
 * @method static string crc32(string $value)
 * @method static string crc32b(string $value)
 * @method static string crc32c(string $value)
 * @method static string fnv132(string $value)
 * @method static string fnv1a32(string $value)
 * @method static string fnv164(string $value)
 * @method static string fnv1a64(string $value)
 * @method static string joaat(string $value)
 * @method static string murmur3a(string $value)
 * @method static string murmur3c(string $value)
 * @method static string murmur3f(string $value)
 * @method static string xxh32(string $value)
 * @method static string xxh64(string $value)
 * @method static string xxh3(string $value)
 * @method static string xxh128(string $value)
 */
abstract class Hash implements UtilizableInterface
{
    use Bridgeable, Utilizable\Strings;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static ?EnumerableInterface $algorithms = null;

    /**
     * @param  array<int|string, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): string
    {
        $value = Arr::first($arguments);

        return static::relay($method)->get($value, $method);
    }

    public static function bind(?string $algorithm = null): Closure
    {
        return static::{static::algorithm($algorithm)}(...);
    }

    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? static::utilize();
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function algorithms(): EnumerableInterface
    {
        return static::$algorithms ??= hash_algos() |> Collection::create(...);
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

    public static function get(string $value, ?string $algorithm = null): string
    {
        $algorithm = static::algorithm($algorithm);

        HashException::for($algorithm)->throw(...) |> static::algorithms()->whereValueExactly($algorithm)->whenEmpty(...);

        return hash($algorithm, $value);
    }

    protected static function variant(string $algorithm, string $value, null|int|string $variant, string $delimiter): string
    {
        $algorithm = Str::rtrim("$algorithm$delimiter$variant", $delimiter);

        return static::get($algorithm);
    }

    protected static function hydrate(): string
    {
        return 'md5';
    }
}
