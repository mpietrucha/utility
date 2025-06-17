<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward\Contracts\TapInterface;
use Mpietrucha\Utility\Forward\Tap;
use Mpietrucha\Utility\Value;

trait Tappable
{
    public function tap(mixed $handler = null, mixed ...$arguments): TappableInterface|TapInterface
    {
        Value::pipe($this, $handler)->eval($arguments);

        return func_num_args() ? $this : Tap::create($this);
    }
}
