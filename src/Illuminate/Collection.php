<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Illuminate\Concerns\Enumerable;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Illuminate\Support\Collection <TKey, TValue>
 *
 * @implements \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<TKey, TValue>
 */
class Collection extends \Illuminate\Support\Collection implements EnumerableInterface
{
    /**
     * @use \Mpietrucha\Utility\Illuminate\Concerns\Enumerable<TKey, TValue>
     */
    use Enumerable;
}
