<?php

namespace Mpietrucha\Utility\Concerns;

use Closure;
use Mpietrucha\Utility\Reflection;
use Mpietrucha\Utility\Value;
use Mpietrucha\Utility\Value\Evaluation;

trait Transformable
{
    /**
     * Transform the evaluated transformable value using the given callback.
     */
    public function transform(mixed $evaluable, mixed ...$arguments): mixed
    {
        return $this->transformable()
            |> Value::for(...)
            |> fn (Evaluation $evaluation) => $evaluation->eval($arguments)
            |> fn (mixed $value) => Value::pipe($value, $evaluable);
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
