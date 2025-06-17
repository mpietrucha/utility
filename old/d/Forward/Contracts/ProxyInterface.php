<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface ProxyInterface
{
    public function __call(string $method, array $arguments): mixed;
}
