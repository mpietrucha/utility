<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;

/**
 * @mixin \Mpietrucha\Utility\Value\Result
 */
class Attempt extends Evaluation implements AttemptInterface
{
    /**
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $forward = $this->eval($arguments) |> $this->forward(...);

        if ($this->unsupported()) {
            return $forward->get($method);
        }

        return $forward->guess($method, $arguments, $this->evaluable());
    }

    /**
     * Safely invoke the evaluable with the given arguments, returning a result wrapper.
     */
    public function __invoke(mixed ...$arguments): ResultInterface
    {
        return parent::__invoke(...$arguments);
    }

    /**
     * Evaluate the callable with the given arguments and return a result instance.
     */
    public function get(mixed ...$arguments): ResultInterface
    {
        return parent::get(...$arguments);
    }

    /**
     * Attempt to evaluate the callable and return a result,
     * capturing any thrown exception alongside the value.
     */
    public function eval(array $arguments): ResultInterface
    {
        $value = $error = null;

        try {
            $value = parent::eval($arguments);
        } catch (Throwable $error) {
        }

        return Result::create($value, $error);
    }
}
