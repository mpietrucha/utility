<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Backtrace\Frame;
use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Throwable;

abstract class Backtrace
{
    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    public static function throwable(Throwable|InteractsWithThrowableInterface $throwable): EnumerableInterface
    {
        if ($throwable instanceof InteractsWithThrowableInterface) {
            $throwable = $throwable->value();
        }

        $backtrace = $throwable->getTrace();

        return static::build($backtrace);
    }

    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    public static function get(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT): EnumerableInterface
    {
        $backtrace = debug_backtrace($options);

        return static::build($backtrace);
    }

    /**
     * @param  list<array<string, array<mixed>|int|object|string>>  $backtrace
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    protected static function build(array $backtrace): EnumerableInterface
    {
        return Collection::create($backtrace)->map(Frame::create(...));
    }
}
