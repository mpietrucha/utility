<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Illuminate\Concerns\Enumerable;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Illuminate\Support\LazyCollection <TKey, TValue>
 *
 * @implements \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<TKey, TValue>
 */
class LazyCollection extends \Illuminate\Support\LazyCollection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Illuminate\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;
}
