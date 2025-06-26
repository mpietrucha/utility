<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

interface ReflectionInterface
{
    /**
     * Create a reflection for the deepest parent class of the given instance or class name.
     */
    public static function deep(object|string $instance): ReflectionInterface;

    /**
     * Determine whether the reflected class lacks the given method.
     */
    public function doesntHaveMethod(string $method): bool;

    /**
     * Determine whether the reflected class lacks the given property.
     */
    public function doesntHaveProperty(string $property): bool;
}
