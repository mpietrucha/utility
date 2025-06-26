<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\TapInterface;

interface TappableInterface
{
    /**
     * Execute the callback, returning a tap proxy if no arguments given,
     * otherwise the original instance.
     */
    public function tap(mixed $evaluable = null, mixed ...$arguments): static|TapInterface;
}
