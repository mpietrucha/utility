<?php

namespace Mpietrucha\Utility\Value;

use Closure;
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

    protected mixed $previous = null;

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
        $forward = Normalizer::class |> $this->forward(...);

        $value = $this->eval($arguments);

        return $forward->get($method, $value);
    }

    /**
     * Invoke the evaluation using the given arguments.
     */
    public function __invoke(mixed ...$arguments): mixed
    {
        return $this->eval($arguments);
    }

    /**
     * @param  array<array-key, mixed>|null  $arguments
     */
    public static function bind(mixed $evaluable, ?array $arguments): Closure
    {
        $evaluation = static::create($evaluable);

        return fn () => Normalizer::array($arguments) |> $evaluation->eval(...);
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

    public function previous(): mixed
    {
        return $this->previous;
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

        return $this->previous = $this->supported() ? $value(...$arguments) : $value;
    }
}
