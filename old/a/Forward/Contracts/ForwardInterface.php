<?php

namespace Mpietrucha\Utility\Forward\Concerns\Contracts;

interface ForwardInterface
{
    public function destination(): object|string;

    public function source(): object|string;

    public function attempt(): InvokableInterface;

    public function proxy(): ProxyInterface;

    public function get(string $method): mixed;

    public function eval(string $method, array $arguments): mixed;
}
