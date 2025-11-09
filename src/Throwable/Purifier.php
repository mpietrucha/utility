<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

/**
 * @phpstan-import-type BacktraceFramesCollection from \Mpietrucha\Utility\Backtrace
 */
abstract class Purifier implements CompatibleInterface
{
    use Compatible;

    /**
     * Get the namespace used to filter internal throwable frames.
     */
    public static function namespace(): string
    {
        return ThrowableInterface::class;
    }

    /**
     * Get the index of the last internal throwable frame in the backtrace.
     *
     * @param  BacktraceFramesCollection  $backtrace
     */
    public static function index(EnumerableInterface $backtrace): int
    {
        return static::filter($backtrace)->count() - 1;
    }

    /**
     * Filter the backtrace to include only internal throwable frames.
     *
     * @param  BacktraceFramesCollection  $backtrace
     * @return BacktraceFramesCollection
     */
    public static function filter(EnumerableInterface $backtrace): EnumerableInterface
    {
        return static::compatible(...) |> $backtrace->takeWhile(...);
    }

    /**
     * Determine if the given frame is compatible as an internal throwable frame.
     */
    protected static function compatibility(FrameInterface $frame): bool
    {
        return static::namespace() |> $frame->internal(...);
    }
}
