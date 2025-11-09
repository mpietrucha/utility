<?php

namespace Mpietrucha\Utility\Forward\Concerns;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

trait Forwardable
{
    /**
     * Create a proxy that relays method calls to the destination with optional method filtering.
     */
    protected function relay(string $method, null|object|string $destination = null, ?MethodsInterface $methods = null): ProxyInterface
    {
        return $this->proxy($destination, $method, $methods);
    }

    /**
     * Create a proxy that forwards allowed method calls to the given destination, optionally specifying a default method name.
     */
    protected function proxy(null|object|string $destination = null, ?string $method = null, ?MethodsInterface $methods = null): ProxyInterface
    {
        return $this->forward($destination, $method)->proxy($methods);
    }

    /**
     * Create a Forward instance configured for the given destination and method, defaulting to the current instance as source if none provided.
     */
    protected function forward(null|object|string $destination = null, ?string $method = null): ForwardInterface
    {
        $destination ??= $this;

        return Forward::create($destination, $this, $method);
    }
}
