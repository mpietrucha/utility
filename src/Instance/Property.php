<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class Property
{
    /**
     * Determine if a property exists on the given instance or class.
     */
    public static function exists(object|string $instance, string $property): bool
    {
        return Instance::exists($instance) && property_exists($instance, $property);
    }

    /**
     * Determine if a property does not exist on the given instance or class.
     */
    final public static function unexists(object|string $instance, string $property): bool
    {
        return static::exists($instance, $property) |> Normalizer::not(...);
    }
}
