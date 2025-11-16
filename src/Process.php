<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Process\Adapter;

/**
 * @mixin \Mpietrucha\Utility\Process\Adapter
 */
abstract class Process
{
    use Bridgeable;

    protected static ?Adapter $adapter = null;

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $adapter = static::adapter();

        return static::bridge($adapter)->eval($method, $arguments);
    }

    public static function adapter(): Adapter
    {
        return static::$adapter ??= new Adapter;
    }
}
