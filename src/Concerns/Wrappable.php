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
        if ($value instanceof static) {
            return $value;
        }

        return static::create($value, ...$arguments);
    }
}
