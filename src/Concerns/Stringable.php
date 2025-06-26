<?php

namespace Mpietrucha\Utility\Concerns;

trait Stringable
{
    /**
     * Convert the instance to its string representation.
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Get the string representation of the instance.
     */
    public function toString(): string
    {
        return '';
    }
}
