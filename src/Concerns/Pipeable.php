<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Value;

trait Pipeable
{
    /**
     * Pass the current instance through the given evaluable callback,
     * optionally with additional arguments, and return the transformed result.
     */
    public function pipe(mixed $evaluable, mixed ...$arguments): mixed
    {
        return Value::pipe($this, $evaluable)->eval($arguments);
    }
}
