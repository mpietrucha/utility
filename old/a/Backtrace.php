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

        return static::build($throwable->getTrace());
    }

    public static function get(): Collection
    {
        return static::build(debug_backtrace());
    }

    protected static function build(array $backtrace): Collection
    {
        return Collection::create($backtrace)->map(Frame::create(...));
    }
}
