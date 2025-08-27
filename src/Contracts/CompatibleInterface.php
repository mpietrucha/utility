<?php

namespace Mpietrucha\Utility\Contracts;

interface CompatibleInterface
{
    /**
     * Determine whether the given arguments are supported by forwarding
     * a supportability check through the dynamic proxy.
     */
    public static function compatible(mixed ...$arguments): bool;

    /**
     * Determine whether the given arguments are not supported by negating
     * the result of the supportability check.
     */
    public static function incompatible(mixed ...$arguments): bool;
}
