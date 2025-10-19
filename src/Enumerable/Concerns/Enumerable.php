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
use Mpietrucha\Utility\Enumerable\Filter;
use Mpietrucha\Utility\Enumerable\LazyCollection;
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
    use Arrayable, Conditionable, Creatable, Pipeable, Stringable, Tappable, Wrappable {
        Wrappable::wrap as bind;
    }

    /**
     * @var list<string>
     */
    protected static array $forwarders = [
        'firstMap',
    ];

    public function __get(mixed $key): mixed
    {
        static::$forwarders = Arr::map(static::$forwarders, static::proxy(...)) |> Arr::whereNotNull(...);

        return parent::__get($key);
    }

    public static function from(mixed ...$items): static
    {
        return static::create($items);
    }

    public static function sequence(int $number, mixed $value = null): static
    {
        return static::times($number, Value::for($value));
    }

    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * @return \Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable
    {
        return parent::getIterator();
    }

    public function toString(): string
    {
        return $this->toJson();
    }

    public function all(): array
    {
        return parent::all();
    }

    /**
     * @return \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    public function collect(): Collection
    {
        return Collection::create($this);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<TKey, TValue>
     */
    public function lazy(): LazyCollection
    {
        return LazyCollection::create($this);
    }

    public function hash(?string $algorithm = null): string
    {
        return $this->toString() |> Hash::bind($algorithm);
    }

    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static
    {
        return $this->operatorForWhere(...func_get_args()) |> $this->reject(...);
    }

    public function whereValue(mixed $values, bool $strict = false): static
    {
        return Filter\Value::create($values, $strict) |> $this->filter(...);
    }

    final public function whereValueStrict(mixed $values): static
    {
        return $this->whereValue($values, true);
    }

    public function whereValueExactly(mixed $values): static
    {
        return Filter\Value::wrap($values) |> $this->whereValueStrict(...);
    }

    public function whereNotValue(mixed $value, bool $strict = false): static
    {
        return Filter\Value::create($value, $strict) |> $this->reject(...);
    }

    final public function whereNotValueStrict(mixed $values): static
    {
        return $this->whereNotValue($values, true);
    }

    public function whereNotValueExactly(mixed $values): static
    {
        return Filter\Value::wrap($values) |> $this->whereNotValueStrict(...);
    }

    public function whereType(mixed $types): static
    {
        return Filter\Type::create($types) |> $this->filter(...);
    }

    public function whereNotType(mixed $types): static
    {
        return Filter\Type::create($types) |> $this->reject(...);
    }

    public function whereInstance(mixed $instances): static
    {
        return Filter\Instance::create($instances) |> $this->filter(...);
    }

    public function whereNotInstance(mixed $instances): static
    {
        return Filter\Instance::create($instances) |> $this->reject(...);
    }

    public function replaceNth(null|int|string $key, mixed $value): static
    {
        if (Type::null($key)) {
            return $this;
        }

        /** @var TKey $key */
        return [$key => $this->get($key) |> Value::for($value)->get(...)] |> $this->replace(...);
    }

    public function replaceFirst(mixed $value): static
    {
        $key = $this->keys()->first();

        return $this->replaceNth($key, $value);
    }

    public function replaceLast(mixed $value): static
    {
        $key = $this->keys()->last();

        return $this->replaceNth($key, $value);
    }

    public function mapToBooleans(): static
    {
        return Normalizer::boolean(...) |> $this->map(...);
    }

    public function mapToStrings(): static
    {
        return Normalizer::string(...) |> $this->map(...);
    }

    public function mapToStringables(): static
    {
        return Normalizer::stringable(...) |> $this->map(...);
    }

    public function mapToCollections(): static
    {
        return Normalizer::collection(...) |> $this->map(...);
    }

    public function mapToArrays(): static
    {
        return Normalizer::array(...) |> $this->map(...);
    }

    public function mapToIntegers(): static
    {
        return Normalizer::integer(...) |> $this->map(...);
    }

    public function mapToFloats(): static
    {
        return Normalizer::float(...) |> $this->map(...);
    }

    public function firstMap(mixed $handler): mixed
    {
        $handler = Value::for($handler);

        $value = $this->first($handler);

        return Type::null($value) ? $value : $handler->previous();
    }

    public function pipeSpread(mixed $handler): mixed
    {
        return $this->toArray() |> Value::for($handler)->eval(...);
    }
}
