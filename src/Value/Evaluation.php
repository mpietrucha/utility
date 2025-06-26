<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;

class Evaluation implements CreatableInterface, EvaluationInterface
{
    use Creatable;

    /**
     * Create a new evaluation instance from the given evaluable value.
     */
    public function __construct(protected mixed $evaluable)
    {
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
        return Type::callable($this->evaluable());
    }

    /**
     * Determine if the evaluable is not a valid callable.
     */
    final public function unsupported(): bool
    {
        return Normalizer::not($this->supported());
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

        if ($this->supported()) {
            $value = $value(...$arguments);
        }

        return $value;
    }
}
