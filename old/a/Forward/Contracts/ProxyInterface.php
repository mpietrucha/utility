<?php

namespace Mpietrucha\Utility\Forward\Contracts;

class ProxyInterface
{
    public function __call(string $method, array $arguments): mixed;
}
