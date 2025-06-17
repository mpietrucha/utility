<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward\Contracts\TapInterface;
use Mpietrucha\Utility\Forward\Tap;
use Mpietrucha\Utility\Value;

trait Tappable
{
    public function tap(mixed $tap, mixed ...$arguments): TapInterface|TappableInterface
    {
        Value::pipe($this, $tap)->eval($arguments);

        return func_num_args() === 0 ? Tap::create($this) : $this;
    }
}
