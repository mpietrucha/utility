<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

class Proxy implements CreatableInterface, ProxyInterface
{
    use Creatable;

    public function __construct(protected ForwardInterface $forward)
    {
    }

    public function __call(string $method, array $arguments): mixed
    {
        return $this->forward->eval($method, $arguments);
    }
}
