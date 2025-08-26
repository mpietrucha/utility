<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

trait Arrayable
{
    public function toArray(): array
    {
        return [];
    }

    public function toCollection(): EnumerableInterface
    {
        return $this->toArray() |> Collection::create(...);
    }
}
