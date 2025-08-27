<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Normalizer;

trait Supportable
{
    use Bridgeable;

    /**
     * Determine whether the given arguments are supported by forwarding
     * a supportability check through the dynamic proxy.
     */
    public static function supports(mixed ...$arguments): bool
    {
        $relay = __FUNCTION__ |> static::relay(...);

        return $relay->supported(...$arguments) |> Normalizer::boolean(...);
    }

    /**
     * Determine whether the given arguments are not supported by negating
     * the result of the supportability check.
     */
    final public static function doesntSupport(mixed ...$arguments): bool
    {
        $relay = __FUNCTION__ |> static::relay(...);

        return $relay->supported(...$arguments) |> Normalizer::not(...);
    }

    /**
     * Define the default supportability logic, which can be overridden
     * to specify custom support conditions.
     */
    protected static function supported(): mixed
    {
        return false;
    }
}
