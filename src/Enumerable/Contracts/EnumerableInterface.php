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
use Mpietrucha\Utility\Enumerable\Normalizer;

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
 */
interface EnumerableInterface extends Countable, StringableInterface, ArrayableInterface, CreatableInterface, PipeableInterface, TappableInterface, ConditionableInterface, Enumerable
{
    public static function from(mixed ...$items): static;

    public static function bind(mixed $value): static;

    /**
    * @return array<TKey, TValue>
    */
    public function all(): array;

    /**
    * @return \Mpietrucha\Utility\Collection<TKey, TValue>
    */
    public function collect(): Collection;

    /**
    * @return \Mpietrucha\Utility\Enumerable\LazyCollection<TKey, TValue>
    */
    public function lazy(): LazyCollection;

    public function hash(?string $algorithm = null): string;

    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static;

    public function whereValue(mixed $values, bool $strict = false): static;

    public function whereValueStrict(mixed $values): static;

    public function whereValueExactly(mixed $values): static;

    public function whereNotValue(mixed $values, bool $strict): static;

    public function whereNotValueStrict(mixed $values): static;

    public function whereNotValueExactly(mixed $values): static;

    public function whereType(mixed $types): static;

    public function whereNotType(mixed $types): static;

    public function whereInstance(mixed $instances): static;

    public function whereNotInstance(mixed $instances): static;

    public function replaceNth(null|int|string $key, mixed $value): static;

    public function replaceFirst(mixed $value): static;

    public function replaceLast(mixed $value): static;

    public function mapToBooleans(): static;

    public function mapToStrings(): static;

    public function mapToStringables(): static;

    public function mapToCollections(): static;

    public function mapToArrays(): static;

    public function mapToIntegers(): static;

    public function mapToFloats(): static;

    public function firstMap(mixed $handler): mixed;

    public function pipeSpread(mixed $handler): mixed;
}
