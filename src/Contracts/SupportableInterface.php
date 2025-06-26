<?php

namespace Mpietrucha\Utility\Contracts;

interface SupportableInterface
{
    /**
     * Determine whether the given arguments are supported by forwarding
     * a supportability check through the dynamic proxy.
     */
    public static function supported(mixed ...$arguments): bool;

    /**
     * Determine whether the given arguments are not supported by negating
     * the result of the supportability check.
     */
    public static function unsupported(mixed ...$arguments): bool;
}
