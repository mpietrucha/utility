<?php

namespace Mpietrucha\Utility;

abstract class Hash
{
    /**
     * @param  array{0: string}  $arguments
     */
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
