<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

abstract class Backtrace
{
    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    public static function proxied(EnumerableInterface $backtrace): bool
    {
        return Frame::proxy(...) |> $backtrace->first(...) |> Type::not()->null(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    final public static function unproxied(EnumerableInterface $backtrace): bool
    {
        return static::proxied($backtrace) |> Normalizer::not(...);
    }
}
