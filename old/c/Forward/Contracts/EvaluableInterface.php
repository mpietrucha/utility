<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface EvaluableInterface
{
    public function __invoke(string $method, array $arguments): mixed;

    public function source(): object|string;

    public function instantiated(): bool;

    public function uninstantiated(): bool;
}
