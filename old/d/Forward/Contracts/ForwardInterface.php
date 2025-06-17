<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface ForwardInterface extends InteractsWithDestinationInterface
{
    public function source(): object|string;

    public function proxy(): ProxyInterface;

    public function evaluable(): EvaluableInterface;

    public function get(string $method): mixed;

    public function eval(string $method, array $arguments): mixed;
}
