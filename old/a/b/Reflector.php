<?php

namespace Mpietrucha\Utility;

use ReflectionClass;

abstract class Reflector
{
    public static function deep(object|string $instance): ReflectionClass
    {
        $reflection = new ReflectionClass($instance);

        while ($deep = $reflection->getParentClass()) {
            $reflection = $deep;
        }

        return $reflection;
    }
}
