<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface ContextInterface extends ProxyInterface
{
    /**
     * Forward the method call to the proxied object and return true if
     * the boolean value of the result matches the expected context value.
     */
    public function __call(string $method, array $arguments): bool;
}
