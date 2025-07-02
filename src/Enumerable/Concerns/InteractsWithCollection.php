<?php

namespace Mpietrucha\Utility\Enumerable\Concerns;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\LazyCollection;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 */
trait InteractsWithCollection
{
    /**
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return [];
    }

    /**
     * @return \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    public function collect(): Collection
    {
        return Collection::create($this->all());
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this->all(...));
    }
}
