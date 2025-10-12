<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface EvaluationInterface extends EvaluableInterface
{
    /**
     * Invoke the evaluable using variadic arguments.
     */
    public function __invoke(mixed ...$arguments): mixed;

    /**
     * Evaluate the callable with variadic arguments and return the result.
     */
    public function get(mixed ...$arguments): mixed;

    /**
     *  Evaluate the callable using the given array of arguments.
     *
     * @param  array<array-key, mixed>  $arguments
     */
    public function eval(array $arguments): mixed;
}
