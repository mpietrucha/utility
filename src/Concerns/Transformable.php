<?php

namespace Mpietrucha\Utility\Concerns;

use Closure;
use Mpietrucha\Utility\Reflection;
use Mpietrucha\Utility\Value;

trait Transformable
{
    /**
     * Transform the evaluated transformable value using the given callback.
     */
    public function transform(mixed $evaluable, mixed ...$arguments): mixed
    {
        $value = Value::for($this->transformable())->eval($arguments);

        return Value::pipe($value, $evaluable)->get();
    }

    /**
     * Get the name of the method to be used as the transformer callback.
     */
    protected function transformer(): string
    {
        return 'get';
    }

    /**
     * Retrieve a Closure representing the transformable method, or null if it doesn't exist.
     */
    protected function transformable(): ?Closure
    {
        $reflection = Reflection::create($this);

        $method = $this->transformer();

        if ($reflection->doesntHaveMethod($method)) {
            return null;
        }

        return $reflection->getMethod($method)->getClosure();
    }
}
