<?php

namespace Mpietrucha\Utility;

abstract class Hash
{
    public static function __callStatic(string $method, array $arguments): string
    {
        $handler = hash(...);

        return Value::for($handler)->get($method, ...$arguments);
    }

    final public static function default(): string
    {
        return 'md5';
    }
}
