<?php

namespace Mpietrucha\Utility\Illuminate\Contracts;

use Mpietrucha\Utility\Illuminate\Collection;
use Mpietrucha\Utility\Illuminate\LazyCollection;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface InteractsWithCollectionInterface
{
    /**
     * @return array<TKey, TValue>
     */
    public function all(): array;

    /**
     * @return \Mpietrucha\Utility\Illuminate\Collection<TKey, TValue>
     */
    public function collect(): Collection;

    /**
     * @return \Mpietrucha\Utility\Illuminate\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection;
}
