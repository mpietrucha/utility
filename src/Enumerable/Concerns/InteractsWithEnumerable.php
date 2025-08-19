<?php

namespace Mpietrucha\Utility\Enumerable\Concerns;

use Mpietrucha\Utility\Concerns\Conditionable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Enumerable\Normalizer;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Value;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 */
trait InteractsWithEnumerable
{
    /**
     * @use \Mpietrucha\Utility\Enumerable\Concerns\InteractsWithCollection<TKey, TValue>
     */
    use Conditionable, Creatable, InteractsWithCollection, Pipeable, Tappable;

    public static function from(mixed ...$items): static
    {
        return static::create($items);
    }

    /**
     * Convert the collection to a plain array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }

    /**
     * Get all of the items in the collection as an array.
     *
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return parent::all();
    }

    public function of(): Normalizer
    {
        return Normalizer::create($this);
    }

    public function hash(?string $algorithm = null): string
    {
        $algorithm ??= Hash::default();

        return $this->toJson() |> Hash::$algorithm(...);
    }

    public function whereNot(callable|string $key, mixed $operator = null, mixed $value = null): static
    {
        return $this->operatorForWhere(...func_get_args()) |> $this->reject(...);
    }

    public function replaceNth(int|string $key, mixed $value): static
    {
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
}
