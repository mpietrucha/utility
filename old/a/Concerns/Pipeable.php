<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Value;

trait Pipeable
{
    public function pipe(mixed $pipe, mixed ...$arguments): mixed
    {
        return Value::get($pipe, $this, ...$arguments);
    }
}
