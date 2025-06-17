<?php

namespace Mpietrucha\Utility\Illuminate\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;

/**
 * @template TKey of array-key
 * @template TValue
 */
trait Enumerable
{
    /**
     * @use \Mpietrucha\Utility\Illuminate\Concerns\InteractsWithCollection<TKey, TValue>
     */
    use Creatable, InteractsWithCollection;

    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return parent::all();
    }
}
