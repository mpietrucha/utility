<?php

namespace Mpietrucha\Utility\Hash\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface HashableInterface
{
    /**
     * Get the hashing algorithm name.
     */
    public static function algorithm(?string $algorithm = null): string;

    /**
     * Get all available hashing algorithms.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function algorithms(): EnumerableInterface;

    /**
     * Hash the given value using the specified algorithm.
     */
    public static function hash(string $value, ?string $algorithm = null): string;
}
