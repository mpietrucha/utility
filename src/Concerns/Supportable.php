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
        $bridge = Forward::namespace(__METHOD__)->proxy();

        return Normalizer::boolean($bridge->supportable(...$arguments));
    }

    /**
     * Determine whether the given arguments are not supported by negating
     * the result of the supportability check.
     */
    final public static function unsupported(mixed ...$arguments): bool
    {
        return Normalizer::not(static::supported(...$arguments));
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
