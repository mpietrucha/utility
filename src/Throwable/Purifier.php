<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Value;

abstract class Purifier implements CompatibleInterface
{
    use Compatible;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    public static function each(EnumerableInterface $backtrace, mixed $callback): void
    {
        static::index($backtrace) |> Value::for($callback)->get(...);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    public static function index(EnumerableInterface $backtrace): int
    {
        return static::filter($backtrace)->count() - 1;
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>
     */
    public static function filter(EnumerableInterface $backtrace): EnumerableInterface
    {
        return static::compatible(...) |> $backtrace->takeWhile(...);
    }

    protected static function compatibility(FrameInterface $frame): bool
    {
        return $frame->internal(FrameInterface::class);
    }
}
