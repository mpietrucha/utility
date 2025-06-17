<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Value;

trait Pipeable
{
    public function pipe(mixed $pipe, mixed ...$arguments): mixed
    {
        return Value::pipe($this, $pipe)->eval($arguments);
    }
}
