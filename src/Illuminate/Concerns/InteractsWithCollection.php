<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

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
     * @return \Mpietrucha\Utility\Illuminate\Collection<TKey, TValue>
     */
    public function collect(): Collection
    {
        return Collection::create($this->all());
    }

    /**
     * @return \Mpietrucha\Utility\Illuminate\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this->all(...));
    }
}
