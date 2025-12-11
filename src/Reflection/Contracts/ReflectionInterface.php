<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

/**
 * @phpstan-require-extends \ReflectionClass
 */
interface ReflectionInterface extends InteractsWithReflectionInterface
{
    /**
     * Create a reflection for the deepest parent class of the given instance or class name.
     */
    public static function deep(object|string $instance): static;
}
