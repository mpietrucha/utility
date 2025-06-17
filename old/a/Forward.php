<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;

class Forward implements ForwardInterface
{
    public function __construct()
    {

    }

    public function proxy(): ProxyInterface
    {
        return Proxy::create($this);
    }

    public function attempt(): InvokableInterface
    {
        return $this->attempt ??= Attempt::create($this->destination());
    }

    public function get(string $method, mixed ...$arguments): mixed
    {
        return $this->eval($method, $arguments);
    }

    public function eval(string $method, array $arguments): mixed
    {

    }
}
