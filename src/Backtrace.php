<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Backtrace\Frame;
use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Throwable;

abstract class Backtrace
{
    public static function throwable(Throwable|InteractsWithThrowableInterface $throwable): EnumerableInterface
    {
        $throwable instanceof InteractsWithThrowableInterface && $throwable = $throwable->value();

        $backtrace = $throwable->getTrace();

        return static::build($backtrace);
    }

    public static function get(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT): EnumerableInterface
    {
        $backtrace = debug_backtrace($options);

        return static::build($backtrace);
    }

    protected static function build(array $backtrace): EnumerableInterface
    {
        return Collection::create($backtrace)->map(Frame::create(...));
    }
}
