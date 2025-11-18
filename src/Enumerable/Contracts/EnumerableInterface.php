<?php

namespace Mpietrucha\Utility\Enumerable\Contracts;

use Countable;
use Illuminate\Support\Enumerable;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\ConditionableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<TKey, TValue>
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
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'firstMap', TValue, static> $firstMap
 * @property-read \Illuminate\Support\HigherOrderCollectionProxy<'skipUntilLast', TValue, static> $skipUntilLast
 */
 interface EnumerableInterface extends Countable, StringableInterface, ArrayableInterface, CreatableInterface, PipeableInterface, TappableInterface, ConditionableInterface, Enumerable
{
    /**
     * Create a new enumerable from the given items.
     */
    public static function from(mixed ...$items): static;

    /**
     * Create a new enumerable bound to the given value.
     */
    public static function bind(mixed $value): static;

    /**
     * Create a new sequence of items.
     */
    public static function sequence(int $number, mixed $value = null): static;

    /**
     * Get all items in the enumerable.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array;

    /**
     * Convert the enumerable to a collection.
     *
     * @return \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    public function collect(): Collection;

    /**
     * Convert the enumerable to a lazy collection.
     *
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection;

    /**
     * Get the hash of the enumerable.
     */
    public function hash(?string $algorithm = null): string;

    /**
     * Filter items where the given key does not match the value.
     */
    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static;

    /**
     * Filter items by the given value.
     */
    public function whereValue(mixed $values, bool $strict = false): static;

    /**
     * Filter items by the given value using strict comparison.
     */
    public function whereValueStrict(mixed $values): static;

    /**
     * Filter items by the given value using exact comparison.
     */
    public function whereValueExactly(mixed $values): static;

    /**
     * Filter items excluding the given value.
     */
    public function whereNotValue(mixed $values, bool $strict): static;

    /**
     * Filter items excluding the given value using strict comparison.
     */
    public function whereNotValueStrict(mixed $values): static;

    /**
     * Filter items excluding the given value using exact comparison.
     */
    public function whereNotValueExactly(mixed $values): static;

    /**
     * Filter items by the given type.
     */
    public function whereType(mixed $types): static;

    /**
     * Filter items excluding the given type.
     */
    public function whereNotType(mixed $types): static;

    /**
     * Filter items by the given instance.
     */
    public function whereInstance(mixed $instances): static;

    /**
     * Filter items excluding the given instance.
     */
    public function whereNotInstance(mixed $instances): static;

    /**
     * Replace the nth item with the given value.
     */
    public function replaceNth(null|int|string $key, mixed $value): static;

    /**
     * Replace the first item with the given value.
     */
    public function replaceFirst(mixed $value): static;

    /**
     * Replace the last item with the given value.
     */
    public function replaceLast(mixed $value): static;

    /**
     * Map all items to booleans.
     */
    public function mapToBooleans(): static;

    /**
     * Map all items to strings.
     */
    public function mapToStrings(): static;

    /**
     * Map all items to stringables.
     */
    public function mapToStringables(): static;

    /**
     * Map all items to collections.
     */
    public function mapToCollections(): static;

    /**
     * Map all items to arrays.
     */
    public function mapToArrays(): static;

    /**
     * Map all items to integers.
     */
    public function mapToIntegers(): static;

    /**
     * Map all items to floats.
     */
    public function mapToFloats(): static;

    /**
     * Get the first mapped value.
     */
    public function firstMap(mixed $handler): mixed;

    /**
     * Pass the enumerable to the callback with spread values.
     */
    public function pipeSpread(mixed $handler): mixed;

    public function skipUntilLast(callable $handler): static;
}
