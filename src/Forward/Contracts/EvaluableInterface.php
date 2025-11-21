<?php

namespace Mpietrucha\Utility\Forward\Contracts;

/**
 * @phpstan-import-type ForwardInput from \Mpietrucha\Utility\Forward\Contracts\ForwardInterface
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
interface EvaluableInterface
{
    /**
     * Dynamically invoke the given method with the provided arguments,
     * calling as an instance method if the source is instantiated,
     * or as a static method if the source is a class name.
     *
     * @param  MixedArray  $arguments
     */
    public function __invoke(string $method, array $arguments): mixed;

    /**
     * Get the underlying source, which may be an object instance or a class name.
     *
     * @return ForwardInput
     */
    public function source(): object|string;

    /**
     * Determine if the source is an instantiated object.
     *
     * @phpstan-assert-if-true object $this->source()
     * @phpstan-assert-if-true false $this->uninstantiated()
     *
     * @phpstan-assert-if-false class-string $this->source()
     * @phpstan-assert-if-false true $this->uninstantiated()
     */
    public function instantiated(): bool;

    /**
     * Determine if the source is an uninstantiated class name.
     *
     * @phpstan-assert-if-true class-string $this->source()
     * @phpstan-assert-if-true false $this->instantiated()
     *
     * @phpstan-assert-if-false object $this->source()
     * @phpstan-assert-if-false true $this->instantiated()
     */
    public function uninstantiated(): bool;
}
