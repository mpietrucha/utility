<?php

namespace Mpietrucha\Utility\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use IteratorAggregate;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \IteratorAggregate<TKey, TValue>
 * @extends \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 */
interface ArrayableInterface extends Arrayable, IteratorAggregate
{
    /**
     * Convert the instance to an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;

    /**
     * Convert the instance to a collection.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>
     */
    public function toCollection(): EnumerableInterface;
}
