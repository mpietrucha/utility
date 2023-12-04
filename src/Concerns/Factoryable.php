<?php

namespace Mpietrucha\Support\Concerns;

trait Factoryable
{
    public static function create(mixed ...$arguments): self
    {
        return new static(...$arguments);
    }
}
