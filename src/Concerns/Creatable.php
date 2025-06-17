<?php

namespace Mpietrucha\Utility\Concerns;

trait Creatable
{
    public static function create(mixed ...$arguments): static
    {
        return new static(...$arguments);
    }
}
