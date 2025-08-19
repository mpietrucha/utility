<?php

namespace Mpietrucha\Utility\Concerns;

trait Routeable
{
    use Creatable;

    /**
     * Return the given value if it is an instance of the called class,
     * otherwise create and return a new instance with the provided arguments.
     */
    public static function route(mixed $value, mixed ...$arguments): static
    {
        if ($value instanceof static) {
            return $value;
        }

        return static::create(...$arguments);
    }
}
