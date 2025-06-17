<?php

namespace Mpietrucha\Utility\Concerns;

trait Pipeable
{
    public function pipe(mixed $handler, mixed ...$arguments): mixed
    {
        return Transformer::eval($this, $handler, $arguments);
    }
}
