<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Forward\Tap;

trait Tappable
{
    public function tap(mixed $handler = null, mixed ...$arguments): TappableInterface|ProxyInterface
    {
        Transformer::eval($this, $handler, $arguments);

        return func_num_args() ? $this : Tap::create($this);
    }
}
