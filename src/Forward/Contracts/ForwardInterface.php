<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Value\Contracts\ResultInterface;

interface ForwardInterface
{
    public static function builder(object|string $destination): BuilderInterface;

    /**
     *  Get the source class or object, defaulting to the destination when none was explicitly set.
     */
    public function source(): object|string;

    /**
     * Get the destination class or object that method calls will be forwarded to.
     */
    public function destination(): object|string;

    /**
     *  Get the method name to be used when forwarding, if any.
     */
    public function method(): ?string;

    /**
     * Build a proxy instance that forwards allowed method calls to the destination.
     */
    public function proxy(?MethodsInterface $methods = null): ProxyInterface;

    /**
     * Get the failure handler responsible for managing forwarding exceptions.
     */
    public function failure(): FailureInterface;

    /**
     * Get the evaluable handler responsible for performing method invocations.
     */
    public function evaluable(): EvaluableInterface;

    /**
     *  Invoke the given method on the destination and return its raw result.
     */
    public function get(string $method, mixed ...$arguments): mixed;

    /**
     * Attempt to invoke the given method, returning a Result object that captures the outcome.
     *
     * @param  array<int|string, mixed>  $arguments
     */
    public function attempt(string $method, array $arguments): ResultInterface;

    /**
     * Evaluate the given method on the destination and return the result,
     * or throw an exception using the failure handler if the call fails.
     *
     * @param  array<int|string, mixed>  $arguments
     */
    public function eval(string $method, array $arguments): mixed;
}
