<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

interface ReflectionInterface extends Reflector
{
    public static function deep(object|string $instance): ReflectionInterface;
}
