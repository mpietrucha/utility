<?php

namespace Mpietrucha\Utility;

abstract class Filesystem
{
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $instance = static::instance();

        return static::bridge($instance)->eval($method, $arguments);
    }
}
