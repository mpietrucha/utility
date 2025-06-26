<?php

namespace Mpietrucha\Utility\Illuminate\Contracts;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 */
interface InteractsWithCollectionInterface
{
    /**
     * Get all items in the collection as a plain array.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array;

    /**
     * Convert the items into a standard eager collection instance.
     *
     * @return \Mpietrucha\Utility\Illuminate\Collection<TKey, TValue>
     */
    public function collect(): Collection;

    /**
     * Convert the items into a lazy collection instance.
     *
     * @return \Mpietrucha\Utility\Illuminate\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection;
}
