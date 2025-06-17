<?php

namespace Mpietrucha\Utility\Concerns;

trait Creatable
{
    public static function create(mixed ...$arguments): self
    {
        return new static(...$arguments);
    }
}
