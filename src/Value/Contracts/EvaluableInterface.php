<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface EvaluableInterface
{
    /**
     * Get the raw evaluable value.
     */
    public function evaluable(): mixed;

    /**
     * Determine whether the evaluable is a valid callable.
     *
     * @phpstan-assert-if-true callable $this->evaluable()
     */
    public function supported(): bool;

    /**
     * Determine whether the evaluable is not a valid callable.
     *
     * @phpstan-assert-if-false callable $this->evaluable()
     */
    public function unsupported(): bool;
}
