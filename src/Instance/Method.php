<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class Method
{
    /**
     * Determine if a method exists on the given instance or class.
     */
    public static function exists(object|string $instance, string $method): bool
    {
        return Instance::exists($instance) && method_exists($instance, $method);
    }

    /**
     * Determine if a method does not exist on the given instance or class.
     */
    final public static function unexists(object|string $instance, string $method): bool
    {
        return static::exists($instance, $method) |> Normalizer::not(...);
    }
}
