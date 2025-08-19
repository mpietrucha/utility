<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Normalizer;

trait Supportable
{
    /**
     * Determine whether the given arguments are supported by forwarding
     * a supportability check through the dynamic proxy.
     */
    public static function supported(mixed ...$arguments): bool
    {
        // $bridge = __METHOD__ |> Forward::namespace(...)->proxy();
        // $bridge = Forward::builder(static::class)->method(__METHOD__)->build()->proxy();

        return $bridge->supportable(...$arguments) |> Normalizer::boolean(...);
    }

    /**
     * Determine whether the given arguments are not supported by negating
     * the result of the supportability check.
     */
    final public static function unsupported(mixed ...$arguments): bool
    {
        return static::supported(...$arguments) |> Normalizer::not(...);
    }

    /**
     * Define the default supportability logic, which can be overridden
     * to specify custom support conditions.
     */
    protected static function supportable(): mixed
    {
        return false;
    }
}
