<?php

namespace Mpietrucha\Utility\Forward\Contracts;

interface InvokableInterface
{
    public function __invoke(string $method, mixed ...$arguments): mixed;
}
