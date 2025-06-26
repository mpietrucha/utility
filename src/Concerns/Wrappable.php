<?php

namespace Mpietrucha\Utility\Concerns;

trait Wrappable
{
    use Creatable;

    /**
     * Wrap the given value in a new instance of the called class,
     * or return the value if it is already an instance.
     */
    public static function wrap(mixed $value, mixed ...$arguments): static
    {
        return $value instanceof static ? $value : static::create($value, ...$arguments);
    }
}
