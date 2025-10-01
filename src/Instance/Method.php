<?php

namespace Mpietrucha\Utility\Instance;

use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

abstract class Method
{
    public static function exists(object|string $instance, string $method): bool
    {
        return Instance::exists($instance) && method_exists($instance, $method);
    }

    final public static function unexists(object|string $instance, string $method): bool
    {
        return static::exists($instance, $method) |> Normalizer::not(...);
    }
}
