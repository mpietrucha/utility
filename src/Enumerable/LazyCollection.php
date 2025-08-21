<?php

namespace Mpietrucha\Utility\Enumerable;

use Mpietrucha\Utility\Enumerable\Concerns\Enumerable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Illuminate\Support\LazyCollection<TKey, TValue>
 *
 * @implements \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>
 */
class LazyCollection extends \Illuminate\Support\LazyCollection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;
}
