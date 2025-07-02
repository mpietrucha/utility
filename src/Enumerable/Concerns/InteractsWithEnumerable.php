<?php

namespace Mpietrucha\Utility\Enumerable\Concerns;

use Mpietrucha\Utility\Concerns\Conditionable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 */
trait InteractsWithEnumerable
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\InteractsWithCollection<TKey, TValue>
     */
    use Conditionable, Creatable, InteractsWithCollection, Pipeable, Tappable;

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
