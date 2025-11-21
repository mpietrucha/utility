<?php

namespace Mpietrucha\Utility\Value\Contracts;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
interface AttemptInterface extends EvaluableInterface
{
    /**
     * Invoke the evaluable using variadic arguments and return a result wrapper.
     */
    public function __invoke(mixed ...$arguments): ResultInterface;

    /**
     * Evaluate the callable with variadic arguments and return a ResultInterface instance.
     */
    public function get(mixed ...$arguments): ResultInterface;

    /**
     * Evaluate the callable with the given argument array and return a ResultInterface instance.
     *
     * @param  MixedArray  $arguments
     */
    public function eval(array $arguments): ResultInterface;
}
