<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Forward\Concerns\Bridgeable;
use Mpietrucha\Utility\Process\Adapter;
use Mpietrucha\Utility\Process\Contracts\ProcessInterface;
use Mpietrucha\Utility\Process\Pending;

class Process implements ProcessInterface
{
    use Bridgeable, Creatable;

    protected static ?Adapter $adapter = null;

    protected ?Pending $pending = null;

    /**
     * Dynamically forward static method calls to the process adapter.
     *
     * @param  array<array-key, mixed>  $arguments
     */
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $adapter = static::adapter();

        return static::bridge($adapter)->eval($method, $arguments);
    }

    /**
     * Dynamically forward instance method calls to the pending process.
     *
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

    /**
     * Get the process adapter instance.
     */
    public static function adapter(): Adapter
    {
        return static::$adapter ??= Adapter::create();
    }

    /**
     * Get the pending process instance.
     */
    protected function pending(): Pending
    {
        return $this->pending ??= static::adapter() |> Pending::create(...);
    }
}
