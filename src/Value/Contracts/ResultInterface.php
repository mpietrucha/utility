<?php

namespace Mpietrucha\Utility\Value\Contracts;

use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Throwable;

interface ResultInterface
{
    /**
     * Get the result value produced by the evaluation.
     */
    public function value(): mixed;

    /**
     * Get the raw throwable captured during evaluation, if any.
     */
    public function error(): ?Throwable;

    /**
     * Determine whether the evaluation completed without throwing.
     *
     * @phpstan-assert-if-true null $this->throwable()
     * @phpstan-assert-if-true null $this->error()
     *
     * @phpstan-assert-if-false \Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface $this->throwable()
     * @phpstan-assert-if-false \Throwable $this->error()
     */
    public function succeeded(): bool;

    /**
     * Determine whether the evaluation resulted in an exception.
     *
     * @phpstan-assert-if-true \Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface $this->throwable()
     * @phpstan-assert-if-true \Throwable $this->error()
     *
     * @phpstan-assert-if-false null $this->throwable()
     * @phpstan-assert-if-false null $this->error()
     */
    public function failed(): bool;

    /**
     * Get the structured throwable representation, or null on success.
     */
    public function throwable(): ?InteractsWithThrowableInterface;

    /**
     * Determine if the caught throwable matches the given class or object.
     *
     * @param  class-string|object  $throwable
     */
    public function caught(object|string $throwable): bool;
}
