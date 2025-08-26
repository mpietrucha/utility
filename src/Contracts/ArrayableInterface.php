<?php

namespace Mpietrucha\Utility\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 */
interface ArrayableInterface extends Arrayable
{
    /**
     * Convert the instance to an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>
     */
    public function toCollection(): EnumerableInterface;
}
