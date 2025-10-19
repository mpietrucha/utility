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

    public static function algorithm(?string $algorithm = null): string
    {
        return $algorithm ?? 'md5';
    }

    public static function algorithms(): EnumerableInterface
    {
        return static::$algorithms ??= hash_algos() |> Collection::create(...);
    }

    public static function hash(string $value, ?string $algorithm = null): string
    {
        $algorithm = static::algorithm($algorithm);

        HashAlgorithmException::for($algorithm)->throw(...) |> static::algorithms()->whereValueExactly($algorithm)->whenEmpty(...);

        return hash($algorithm, $value);
    }
}
