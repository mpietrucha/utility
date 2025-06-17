<?php

namespace Mpietrucha\Utility\Illuminate\Contracts;

use Illuminate\Support\Enumerable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<TKey, TValue>
 * @extends \Mpietrucha\Utility\Illuminate\Contracts\InteractsWithCollectionInterface<TKey, TValue>
 * @extends \Illuminate\Support\Enumerable<TKey, TValue>
 */
interface EnumerableInterface extends ArrayableInterface, CreatableInterface, Enumerable, InteractsWithCollectionInterface
{
}
