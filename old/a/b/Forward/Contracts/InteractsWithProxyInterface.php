<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface InteractsWithProxyInterface extends ProxyInterface
{
    public function __call(string $method, array $arguments): mixed;
}
