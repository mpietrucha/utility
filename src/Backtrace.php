<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Backtrace\Frame;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Contracts\ReflectionInterface;
use Throwable;

/**
 * @phpstan-import-type RawBacktraceFrame from \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface
 *
 * @phpstan-type BacktraceFramesCollection \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>
 */
abstract class Backtrace
{
    /**
     * Build a backtrace collection from the given throwable or throwable wrapper.
     *
     * @return BacktraceFramesCollection
     */
    public static function throwable(ReflectionInterface|Throwable $throwable): EnumerableInterface
    {
        if ($throwable instanceof ReflectionInterface) {
            $throwable = $throwable->value();
        }

        return $throwable->getTrace() |> static::build(...);
    }

    /**
     * Build a backtrace collection from the current execution context.
     *
     * @return BacktraceFramesCollection
     */
    public static function get(int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT): EnumerableInterface
    {
        $backtrace = debug_backtrace($options);

        return Arr::skip($backtrace, 1) |> static::build(...);
    }

    /**
     * Transform raw backtrace frames into a typed enumerable of frame objects.
     *
     * @param  list<RawBacktraceFrame>  $backtrace
     * @return BacktraceFramesCollection
     */
    protected static function build(array $backtrace): EnumerableInterface
    {
        return Frame::create(...) |> Collection::create($backtrace)->map(...);
    }
}
