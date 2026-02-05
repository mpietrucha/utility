<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-import-type BacktraceFrameCollection from \Mpietrucha\Utility\Backtrace
 */
abstract class Backtrace
{
    /**
     * Get the default number of frames to skip.
     */
    final public static function frames(): int
    {
        return 11;
    }

    /**
     * Get the proxy interface class name for backtrace filtering.
     */
    public static function proxy(): string
    {
        return ProxyInterface::class;
    }

    /**
     * Determine if the backtrace indicates a proxied forward call.
     *
     * @param  BacktraceFrameCollection  $backtrace
     */
    public static function proxied(EnumerableInterface $backtrace): bool
    {
        return static::proxy() |> $backtrace->first->internal(...) |> Normalizer::boolean(...);
    }

    /**
     * Determine if the backtrace indicates an unproxied forward call.
     *
     * @param  BacktraceFrameCollection  $backtrace
     */
    final public static function unproxied(EnumerableInterface $backtrace): bool
    {
        return static::proxied($backtrace) |> Normalizer::not(...);
    }
}
