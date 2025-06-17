<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface InteractsWithProxyInterface
{
    public function __call(string $method, array $arguments): mixed;
}
