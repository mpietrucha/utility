<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Forward\Contracts\TapInterface;
use Mpietrucha\Utility\Forward\Tap;
use Mpietrucha\Utility\Value;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\TappableInterface
 */
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

        return func_num_args() === 0 ? Tap::create($this) : $this;
    }
}
