<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;

/**
 * @mixin \Mpietrucha\Utility\Normalizer
 */
class Evaluation implements CreatableInterface, EvaluationInterface
{
    use Creatable, Forwardable;

    /**
     * Create a new evaluation instance from the given evaluable value.
     */
    public function __construct(protected mixed $evaluable)
    {
    }

    /**
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $value = $this->eval($arguments);

        return $this->forward(Normalizer::class)->get($method, $value);
    }

    /**
     * Invoke the evaluation using the given arguments.
     */
    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    /**
     * Get the raw evaluable value being wrapped.
     */
    final public function evaluable(): mixed
    {
        return $this->evaluable;
    }

    /**
     * Determine if the evaluable is a valid callable.
     */
    public function supported(): bool
    {
        return $this->evaluable() |> Type::callable(...);
    }

    /**
     * Determine if the evaluable is not a valid callable.
     */
    final public function unsupported(): bool
    {
        return $this->supported() |> Normalizer::not(...);
    }

    /**
     * Evaluate the callable with the given arguments and return the result.
     */
    public function get(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    /**
     * Evaluate the wrapped callable with the given argument array,
     * or return the raw value if not callable.
     */
    public function eval(array $arguments): mixed
    {
        $value = $this->evaluable();

        return $this->supported() ? $value(...$arguments) : $value;
    }
}
