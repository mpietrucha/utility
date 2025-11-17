<?php

namespace Mpietrucha\Utility\Hash\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Hash\Exception\HashAlgorithmException;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Hash\Contracts\HashableInterface
 */
trait Hashable
{
    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static ?EnumerableInterface $algorithms = null;

    /**
     * Get the hash algorithm to use, defaulting to md5.
     */
    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? 'md5';
    }

    /**
     * Get all available hash algorithms.
     */
    public static function algorithms(): EnumerableInterface
    {
        return static::$algorithms ??= hash_algos() |> Collection::create(...);
    }

    /**
     * Generate a hash of the given value using the specified algorithm.
     */
    public static function hash(string $value, ?string $algorithm = null): string
    {
        $algorithm = static::algorithm($algorithm);

        HashAlgorithmException::for($algorithm)->throw(...) |> static::algorithms()->whereValueExactly($algorithm)->whenEmpty(...);

        return hash($algorithm, $value);
    }
}
