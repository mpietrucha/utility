<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Contracts\TapInterface;
use Mpietrucha\Utility\Forward\Tap;
use Mpietrucha\Utility\Value;

trait Tappable
{
    /**
     * Execute the callback, returning a tap proxy if no arguments given,
     * otherwise the original instance.
     *
     * @return \Mpietrucha\Utility\Forward\Tap<static>|static
     */
    public function tap(mixed $evaluable = null, mixed ...$arguments): static|TapInterface
    {
        Value::pipe($this, $evaluable)->eval($arguments);

        return func_num_args() === 1 ? Tap::create($this) : $this;
    }
}
