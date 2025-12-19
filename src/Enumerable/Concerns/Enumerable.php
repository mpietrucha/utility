<?php

namespace Mpietrucha\Utility\Enumerable\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Conditionable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\Filter;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Enumerable\Middleware;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value;
use Traversable;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 *
 * @phpstan-require-implements \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface
 */
trait Enumerable
{
    use Arrayable, Conditionable, Creatable, Pipeable, Stringable, Tappable, Wrappable;

    /**
     * @var list<string>
     */
    protected static array $forwarders = [
        'firstMap',
        'skipUntilLast',
    ];

    /**
     * @var class-string
     */
    protected static string $wrappable = EnumerableInterface::class;

    /**
     * Dynamically access collection proxies.
     */
    public function __get(mixed $key): mixed
    {
        static::$forwarders = Arr::map(static::$forwarders, static::proxy(...)) |> Arr::whereNotNull(...);

        return parent::__get($key);
    }

    /**
     * Create a collection from the given items.
     */
    public static function from(mixed ...$items): static
    {
        return static::create($items);
    }

    /**
     * Create a collection by repeating a value N times.
     */
    public static function sequence(int $number, mixed $value = null): static
    {
        return static::times($number, Value::for($value));
    }

    /**
     * Convert the collection to an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * Get an iterator for the collection.
     *
     * @return \Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    /**
     * Convert the collection to its string representation.
     */
    public function toString(): string
    {
        return $this->toJson();
    }

    /**
     * Get all items in the collection.
     */
    public function all(): array
    {
        return parent::all();
    }

    /**
     * Convert the enumerable to a collection instance.
     *
     * @return \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    public function collect(): Collection
    {
        return Collection::create($this);
    }

    /**
     * Convert the enumerable to a lazy collection instance.
     *
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this);
    }

    /**
     * Generate a hash of the collection using the specified algorithm.
     */
    public function hash(?string $algorithm = null): string
    {
        return $this->toString() |> Hash::bind($algorithm);
    }

    /**
     * Filter items by negating the given key and value condition.
     */
    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static
    {
        return $this->operatorForWhere(...func_get_args()) |> $this->reject(...);
    }

    /**
     * Filter items where the value matches the given values.
     */
    public function whereValue(mixed $values, bool $strict = false): static
    {
        return Filter\Value::create($values, $strict) |> $this->filter(...);
    }

    /**
     * Filter items where the value strictly matches the given values.
     */
    final public function whereValueStrict(mixed $values): static
    {
        return $this->whereValue($values, true);
    }

    /**
     * Filter items where the value exactly matches the given values.
     */
    public function whereValueExactly(mixed $values): static
    {
        return Filter\Value::wrap($values) |> $this->whereValueStrict(...);
    }

    /**
     * Filter items where the value does not match the given value.
     */
    public function whereNotValue(mixed $value, bool $strict = false): static
    {
        return Filter\Value::create($value, $strict) |> $this->reject(...);
    }

    /**
     * Filter items where the value does not strictly match the given values.
     */
    final public function whereNotValueStrict(mixed $values): static
    {
        return $this->whereNotValue($values, true);
    }

    /**
     * Filter items where the value does not exactly match the given values.
     */
    public function whereNotValueExactly(mixed $values): static
    {
        return Filter\Value::wrap($values) |> $this->whereNotValueStrict(...);
    }

    /**
     * Filter items where the value is of the given type.
     */
    public function whereType(mixed $types): static
    {
        return Filter\Type::create($types) |> $this->filter(...);
    }

    /**
     * Filter items where the value is not of the given type.
     */
    public function whereNotType(mixed $types): static
    {
        return Filter\Type::create($types) |> $this->reject(...);
    }

    /**
     * Filter items where the value is an instance of the given class.
     */
    public function whereInstance(mixed $instances): static
    {
        return Filter\Instance::create($instances) |> $this->filter(...);
    }

    /**
     * Filter items where the value is not an instance of the given class.
     */
    public function whereNotInstance(mixed $instances): static
    {
        return Filter\Instance::create($instances) |> $this->reject(...);
    }

    /**
     * Replace the value at the given key.
     */
    public function replaceNth(null|int|string $key, mixed $value): static
    {
        if (Type::null($key)) {
            return $this;
        }

        /** @var TKey $key */
        return [$key => $this->get($key) |> Value::for($value)->get(...)] |> $this->replace(...);
    }

    /**
     * Replace the first value in the collection.
     */
    public function replaceFirst(mixed $value): static
    {
        $key = $this->keys()->first();

        return $this->replaceNth($key, $value);
    }

    /**
     * Replace the last value in the collection.
     */
    public function replaceLast(mixed $value): static
    {
        $key = $this->keys()->last();

        return $this->replaceNth($key, $value);
    }

    /**
     * Map all values to booleans.
     */
    public function mapToBooleans(): static
    {
        return Normalizer::boolean(...) |> $this->map(...);
    }

    /**
     * Map all values to strings.
     */
    public function mapToStrings(): static
    {
        return Normalizer::string(...) |> $this->map(...);
    }

    /**
     * Map all values to stringable instances.
     */
    public function mapToStringables(): static
    {
        return Normalizer::stringable(...) |> $this->map(...);
    }

    /**
     * Map all values to collections.
     */
    public function mapToCollections(): static
    {
        return Normalizer::collection(...) |> $this->map(...);
    }

    /**
     * Map all values to arrays.
     */
    public function mapToArrays(): static
    {
        return Normalizer::array(...) |> $this->map(...);
    }

    /**
     * Map all values to integers.
     */
    public function mapToIntegers(): static
    {
        return Normalizer::integer(...) |> $this->map(...);
    }

    /**
     * Map all values to floats.
     */
    public function mapToFloats(): static
    {
        return Normalizer::float(...) |> $this->map(...);
    }

    /**
     * Get the first item and apply the handler to it.
     */
    public function firstMap(mixed $handler): mixed
    {
        $handler = Value::for($handler);

        $value = $this->first($handler);

        return Type::null($value) ? $value : $handler->previous();
    }

    /**
     * Pass the collection items as spread arguments to the handler.
     */
    public function pipeSpread(mixed $handler): mixed
    {
        return $this->toArray() |> Value::for($handler)->eval(...);
    }

    public function skipUntilLast(callable $handler): static
    {
        return $this->pipeThrough([
            fn (EnumerableInterface $collection) => $collection->skipUntil($handler),
            fn (EnumerableInterface $collection) => $collection->skipWhile($handler),
        ]);
    }

    public function eachKeys(callable $handler): static
    {
        return Middleware\Flip::create($handler) |> $this->each(...);
    }
}
