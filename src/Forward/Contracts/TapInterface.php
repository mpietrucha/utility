<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Contracts\TappableInterface;

interface TapInterface extends ProxyInterface
{
    /**
     * Dynamically proxy the call to the underlying target and return
     * a Tappable proxy instance for fluent method chaining.
     */
    public function __call(string $method, array $arguments): TappableInterface;
}
