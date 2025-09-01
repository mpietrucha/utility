<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Traversable;

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

    public function getIterator(): Traversable
    {
        return $this->toCollection()->getIterator();
    }
}
