<?php

namespace Mpietrucha\Utility\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Traversable;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Contracts\ArrayableInterface
 */
trait Arrayable
{
    /**
     * Convert the instance to an array.
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * Convert the instance to a collection.
     */
    public function toCollection(): EnumerableInterface
    {
        return $this->toArray() |> Collection::create(...);
    }

    /**
     * Get an iterator for the instance.
     */
    public function getIterator(): Traversable
    {
        return $this->toCollection()->getIterator();
    }
}
