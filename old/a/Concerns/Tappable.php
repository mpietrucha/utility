<?php

namespace Mpietrucha\Utility\Concerns;

trait Tappable
{
    public function tap(mixed $tap, mixed ...$arguments): self
    {
        return func_num_args() ? $this : Tap::create($this);
    }
}
