<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Stringable as Adapter;
use Stringable;

interface StringableInterface extends Stringable
{
    /**
     * Get the string representation of the instance.
     */
    public function toString(): string;

    /**
     * Get the Stringable representation of the instance.
     */
    public function toStringable(): Adapter;
}
