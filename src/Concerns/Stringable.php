<?php

namespace Mpietrucha\Utility\Concerns;

trait Stringable
{
    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return '';
    }
}
