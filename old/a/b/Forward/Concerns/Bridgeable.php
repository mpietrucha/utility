<?php

namespace Mpietrucha\Utility\Forward\Concerns;

use Mpietrucha\Utility\Forward\Bridge;
use Mpietrucha\Utility\Forward\Contracts\BridgeInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

trait Bridgeable
{
    protected static function proxy(null|object|string $destination = null, ?string $method = null): ProxyInterface
    {
        return self::bridge($destination, $method)->proxy();
    }

    protected static function bridge(null|object|string $destination = null, ?string $method = null): BridgeInterface
    {
        return Bridge::create($destination, static::class, $method);
    }
}
