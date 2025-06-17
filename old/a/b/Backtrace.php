<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Backtrace\Frame;
use Mpietrucha\Utility\Exception\Contracts\InteractsWithThrowableInterface;
use Mpietrucha\Utility\Illuminate\Collection;
use Throwable;

abstract class Backtrace
{
    public static function throwable(Throwable|InteractsWithThrowableInterface $throwable): Collection
    {
        $throwable instanceof InteractsWithThrowableInterface && $throwable = $throwable->get();

        $backtrace = $throwable->getTrace();

        return self::build($backtrace);
    }

    public static function get(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT): Collection
    {
        $backtrace = debug_backtrace($options);

        return self::build($backtrace);
    }

    protected static function build(array $backtrace): Collection
    {
        return Collection::create($backtrace)->map(Frame::create(...));
    }
}
