<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Process\Adapter;
use Mpietrucha\Utility\Process\Contracts\ProcessInterface;
use Mpietrucha\Utility\Process\Pending;

/**
 * @mixin \Mpietrucha\Utility\Process\Adapter
 * @mixin \Mpietrucha\Utility\Process\Pending
 */
class Process implements ProcessInterface
{
    use Bridgeable, Creatable;

    protected static ?Adapter $adapter = null;

    protected ?Pending $pending = null;

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $adapter = static::adapter();

        return static::bridge($adapter)->eval($method, $arguments);
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $pending = $this->pending();

        $response = static::bridge($pending)->eval($method, $arguments);

        return match (true) {
            $response instanceof Pending => $this,
            default => $response
        };
    }

    public static function adapter(): Adapter
    {
        return static::$adapter ??= Adapter::create();
    }

    protected function pending(): Pending
    {
        return $this->pending ??= static::adapter() |> Pending::create(...);
    }
}
