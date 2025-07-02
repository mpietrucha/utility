<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Condition;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

trait Conditionable
{
    /**
     * Execute the given callback when the provided condition is truthy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function when(...$arguments): mixed
    {
        return $this->condition(true, ...$arguments);
    }

    /**
     * Execute the given callback when the provided condition is falsy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function unless(mixed ...$arguments): mixed
    {
        return $this->condition(false, ...$arguments);
    }

    /**
     * Evaluate a condition against a boolean value, optionally executing a handler or returning a tap proxy.
     */
    protected function condition(bool $value, mixed $condition = null, mixed $handler = null): mixed
    {
        $condition = Normalizer::boolean(
            Value::for($condition)->get($this, $condition)
        ) === $value;

        if (func_num_args() === 2) {
            return Condition::create($this, $condition);
        }

        return $condition ? Value::pipe($this, $handler)->get() : $this;
    }
}
