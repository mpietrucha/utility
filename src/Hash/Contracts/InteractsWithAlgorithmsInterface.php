<?php

namespace Mpietrucha\Utility\Hash\Contracts;

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
interface InteractsWithAlgorithmsInterface extends HashableInterface
{
    public const GOST_CRYPTO = 'crypto';

    /**
     * Hash the given value using MD5.
     */
    public static function md5(string $value): string;

    /**
     * Hash the given value using SHA1.
     */
    public static function sha1(string $value): string;

    /**
     * Get the hash for the given value using the specified algorithm.
     */
    public static function get(string $value, ?string $algorithm = null): string;
}
