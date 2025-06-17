<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Value;

trait Pipeable
{
    public function pipe(mixed $handler, mixed ...$arguments): mixed
    {
        return Value::pipe($this, $handler)->eval($arguments);
    }
}
