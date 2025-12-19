<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Enumerable\Concerns\Enumerable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Illuminate\Support\Collection<TKey, TValue>
 *
 * @implements \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<TKey, TValue>
 */
class Collection extends \Illuminate\Support\Collection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;
}
