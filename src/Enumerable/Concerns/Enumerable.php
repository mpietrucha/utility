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
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 */
trait Enumerable
{
    use Arrayable, Conditionable, Creatable, Pipeable, Stringable, Tappable;

    /**
     * @var array<int, string>
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

    /**
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
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
        $algorithm ??= Hash::default();

        return $this->toString() |> Hash::$algorithm(...);
    }

    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static
    {
        return $this->operatorForWhere(...func_get_args()) |> $this->reject(...);
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
        return $this->replaceNth($this->keys()->first(), $value);
    }

    public function replaceLast(mixed $value): static
    {
        return $this->replaceNth($this->keys()->last(), $value);
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

    public function pipeSpreadInto(mixed $handler): mixed
    {
        return $this->toArray() |> Value::for($handler)->eval(...);
    }
}
