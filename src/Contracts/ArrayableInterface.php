<?php

namespace Mpietrucha\Utility\Contracts;

use Illuminate\Contracts\Support\Arrayable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 */
interface ArrayableInterface extends Arrayable
{
    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array;
}
