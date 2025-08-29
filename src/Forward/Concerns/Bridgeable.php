<?php

namespace Mpietrucha\Utility\Forward\Concerns;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

trait Bridgeable
{
    protected static function relay(string $method, null|object|string $destination = null, ?MethodsInterface $methods = null): ProxyInterface
    {
        return static::proxy($destination, $method, $methods);
    }

    /**
     * Create a proxy for the given destination and method, forwarding allowed calls
     * using an optional methods filter.
     */
    protected static function proxy(null|object|string $destination = null, ?string $method = null, ?MethodsInterface $methods = null): ProxyInterface
    {
        return static::bridge($destination, $method)->proxy($methods);
    }

    /**
     * Create a Forward instance bridging the given destination and method,
     * defaulting the source to the calling class.
     */
    protected static function bridge(null|object|string $destination = null, ?string $method = null): ForwardInterface
    {
        $destination ??= static::class;

        return Forward::create($destination, static::class, $method);
    }
}
