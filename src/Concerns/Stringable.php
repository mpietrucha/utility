<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Stringable as Adapter;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\StringableInterface
 */
trait Stringable
{
    /**
     * Convert the instance to its string representation.
     */
    final public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * Get the string representation of the instance.
     */
    public function toString(): string
    {
        return Str::none();
    }

    final public function toStringable(): Adapter
    {
        return $this->toString() |> Adapter::create(...);
    }
}
