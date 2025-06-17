<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Contracts\TappableInterface;

interface TapInterface extends ProxyInterface
{
    public function __call(string $method, array $arguments): TappableInterface;
}
