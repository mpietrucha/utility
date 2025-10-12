<?php

namespace Mpietrucha\Utility\Hash\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface HashableInterface
{
    public static function algorithm(?string $algorithm = null): string;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public static function algorithms(): EnumerableInterface;

    public static function hash(string $value, ?string $algorithm = null): string;
}
