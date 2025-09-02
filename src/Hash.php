<?php

namespace Mpietrucha\Utility;

/**
 * @method static string md2(string $content)
 * @method static string md4(string $content)
 * @method static string md5(string $content)
 * @method static string sha1(string $content)
 * @method static string sha224(string $content)
 * @method static string sha256(string $content)
 * @method static string sha384(string $content)
 * @method static string sha512_224(string $content)
 * @method static string sha512_256(string $content)
 * @method static string sha512(string $content)
 * @method static string sha3224(string $content)
 * @method static string sha3256(string $content)
 * @method static string sha3384(string $content)
 * @method static string sha3512(string $content)
 * @method static string ripemd128(string $content)
 * @method static string ripemd160(string $content)
 * @method static string ripemd256(string $content)
 * @method static string ripemd320(string $content)
 * @method static string whirlpool(string $content)
 * @method static string tiger128_3(string $content)
 * @method static string tiger160_3(string $content)
 * @method static string tiger192_3(string $content)
 * @method static string tiger128_4(string $content)
 * @method static string tiger160_4(string $content)
 * @method static string tiger192_4(string $content)
 * @method static string snefru(string $content)
 * @method static string snefru256(string $content)
 * @method static string gost(string $content)
 * @method static string gostCrypto(string $content)
 * @method static string adler32(string $content)
 * @method static string crc32(string $content)
 * @method static string crc32b(string $content)
 * @method static string crc32c(string $content)
 * @method static string fnv132(string $content)
 * @method static string fnv1a32(string $content)
 * @method static string fnv164(string $content)
 * @method static string fnv1a64(string $content)
 * @method static string joaat(string $content)
 * @method static string murmur3a(string $content)
 * @method static string murmur3c(string $content)
 * @method static string murmur3f(string $content)
 * @method static string xxh32(string $content)
 * @method static string xxh64(string $content)
 * @method static string xxh3(string $content)
 * @method static string xxh128(string $content)
 * @method static string haval128_3(string $content)
 * @method static string haval160_3(string $content)
 * @method static string haval192_3(string $content)
 * @method static string haval224_3(string $content)
 * @method static string haval256_3(string $content)
 * @method static string haval128_4(string $content)
 * @method static string haval160_4(string $content)
 * @method static string haval192_4(string $content)
 * @method static string haval224_4(string $content)
 * @method static string haval256_4(string $content)
 * @method static string haval128_5(string $content)
 * @method static string haval160_5(string $content)
 * @method static string haval192_5(string $content)
 * @method static string haval224_5(string $content)
 * @method static string haval256_5(string $content)
 */
abstract class Hash
{
    public const string DEFAULT = 'md5';

    protected static ?string $algorithm = null;

    /**
     * @param  array{0: string}  $arguments
     */
    public static function __callStatic(string $method, array $arguments): string
    {
        $method = Str::of($method)->camel()->replace([',', '/'], '_');

        $handler = hash(...);

        return Value::for($handler)->get($method, ...$arguments);
    }

    public static function default(string $algorithm): void
    {
        static::$algorithm = $algorithm;
    }

    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? static::$algorithm ?? static::DEFAULT;
    }

    public static function bind(?string $algorithm = null): callable
    {
        return static::{static::algorithm($algorithm)}(...);
    }
}
