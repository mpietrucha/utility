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
     * @phpstan-assert-if-true false $this->unsupported()
     *
     * @phpstan-assert-if-false null $this->evaluable()
     * @phpstan-assert-if-false true $this->unsupported()
     */
    public function supported(): bool;

    /**
     * Determine whether the evaluable is not a valid callable.
     *
     * @phpstan-assert-if-true null $this->evaluable()
     * @phpstan-assert-if-true false $this->supported()
     *
     * @phpstan-assert-if-false callable $this->evaluable()
     * @phpstan-assert-if-false true $this->supported()
     */
    public function unsupported(): bool;

    public function previous(): mixed;
}
