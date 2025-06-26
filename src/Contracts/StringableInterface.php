<?php

namespace Mpietrucha\Utility\Contracts;

use Stringable;

interface StringableInterface extends Stringable
{
    /**
     * Get the string representation of the instance.
     */
    public function toString(): string;
}
