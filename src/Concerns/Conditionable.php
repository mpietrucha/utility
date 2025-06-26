<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Contracts\TapInterface;
use Mpietrucha\Utility\Forward\Tap;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

trait Conditionable
{
    /**
     * Execute the given callback when the provided condition is truthy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function when(...$arguments): static|TapInterface
    {
        return $this->condition(true, ...$arguments);
    }

    /**
     * Execute the given callback when the provided condition is falsy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function unless(mixed ...$arguments): static|TapInterface
    {
        return $this->condition(false, ...$arguments);
    }

    /**
     * Evaluate a condition against a boolean value, optionally executing a handler or returning a tap proxy.
     */
    protected function condition(bool $value, mixed $condition = null, mixed $handler = null): static|TapInterface
    {
        $condition = Value::for($condition)->get($this, $condition);

        if (Normalizer::not($condition) === $value) {
            return $this;
        }

        if (func_num_args() === 3) {
            return Tap::create($this);
        }

        return Value::tap($this, $handler)->get();
    }
}
