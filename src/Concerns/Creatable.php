<?php

namespace Mpietrucha\Utility\Concerns;

trait Creatable
{
    /**
     * Create a new instance of the class with the given arguments.
     */
    public static function create(mixed ...$arguments): static
    {
        return new static(...$arguments);
    }
}
