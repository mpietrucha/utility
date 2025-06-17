<?php

namespace Mpietrucha\Utility;

use ReflectionClass;

abstract class Reflector
{
    public static function deep(object|string $source): ReflectionClass
    {
        $reflection = new ReflectionClass($source);

        while ($deep = $reflection->getParentClass()) {
            $reflection = $deep;
        }

        return $reflection;
    }
}
