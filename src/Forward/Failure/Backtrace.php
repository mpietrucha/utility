<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Normalizer;

abstract class Backtrace
{
    public static function proxy(): string
    {
        return ProxyInterface::class;
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    public static function proxied(EnumerableInterface $backtrace): bool
    {
        return static::proxy() |> $backtrace->first->internal(...) |> Normalizer::boolean(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    final public static function unproxied(EnumerableInterface $backtrace): bool
    {
        return static::proxied($backtrace) |> Normalizer::not(...);
    }
}
