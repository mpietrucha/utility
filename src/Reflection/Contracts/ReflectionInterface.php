<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

use Reflector;

interface ReflectionInterface extends Reflector
{
    public static function deep(object|string $instance): ReflectionInterface;
}
