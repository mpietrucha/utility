<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class Property
{
    public static function exists(object|string $instance, string $property): bool
    {
        return Instance::exists($instance) && property_exists($instance, $property);
    }

    final public static function unexists(object|string $instance, string $property): bool
    {
        return static::exists($instance, $property) |> Normalizer::not(...);
    }
}
