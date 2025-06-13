<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Contracts\CreatableInterface;

trait Creatable
{
    public static function create(mixed ...$arguments): CreatableInterface
    {
        return new static(...$arguments);
    }
}
