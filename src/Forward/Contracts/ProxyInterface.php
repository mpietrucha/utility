<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface ProxyInterface
{
    /**
     * Forward the dynamic method call and its arguments to the underlying
     * proxied instance, returning whatever value the target produces.
     *
     * @param  array<int|string, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed;
}
