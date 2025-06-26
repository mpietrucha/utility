<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 */
trait Enumerable
{
    /**
     * @use \Mpietrucha\Utility\Illuminate\Concerns\InteractsWithCollection<TKey, TValue>
     */
    use Creatable, InteractsWithCollection;

    /**
     * Convert the collection to a plain array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * Get all of the items in the collection as an array.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return parent::all();
    }
}
