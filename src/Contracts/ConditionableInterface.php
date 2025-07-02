<?php

namespace Mpietrucha\Utility\Contracts;

interface ConditionableInterface
{
    /**
     * Execute the given callback when the provided condition is falsy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function when(mixed ...$arguments): mixed;

    /**
     * Execute the given callback when the provided condition is falsy.
     * Returns a tap proxy if no arguments is provided, otherwise returns the original instance.
     */
    public function unless(mixed ...$arguments): mixed;
}
