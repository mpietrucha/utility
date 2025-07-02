<?php

namespace Mpietrucha\Utility\Enumerable\Contracts;

use Illuminate\Support\Enumerable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\ConditionableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<TKey, TValue>
 * @extends \Mpietrucha\Utility\Enumerable\Contracts\InteractsWithCollectionInterface<TKey, TValue>
 * @extends \Illuminate\Support\Enumerable<TKey, TValue>
 *
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'average', TValue, static> $average
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'avg', TValue, static> $avg
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'contains', TValue, static> $contains
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'each', TValue, static> $each
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'every', TValue, static> $every
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'filter', TValue, static> $filter
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'first', TValue, static> $first
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'flatMap', TValue, static> $flatMap
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'groupBy', TValue, static> $groupBy
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'keyBy', TValue, static> $keyBy
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'map', TValue, static> $map
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'max', TValue, static> $max
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'min', TValue, static> $min
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'partition', TValue, static> $partition
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'reject', TValue, static> $reject
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'some', TValue, static> $some
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'sortBy', TValue, static> $sortBy
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'sortByDesc', TValue, static> $sortByDesc
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'skipUntil', TValue, static> $skipUntil
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'skipWhile', TValue, static> $skipWhile
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'sum', TValue, static> $sum
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'takeUntil', TValue, static> $takeUntil
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'takeWhile', TValue, static> $takeWhile
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'unique', TValue, static> $unique
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'until', TValue, static> $until
 */
interface EnumerableInterface extends ArrayableInterface, CreatableInterface, InteractsWithCollectionInterface, PipeableInterface, TappableInterface, ConditionableInterface, Enumerable
{
}
