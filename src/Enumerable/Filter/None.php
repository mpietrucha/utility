<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\FilterInterface;
use Mpietrucha\Utility\Value;

abstract class None implements CreatableInterface, FilterInterface
{
    use Creatable;

    protected mixed $value;

    /**
     * Create a new filter with the given values to match against.
     */
    public function __construct(protected mixed $values)
    {
    }

    /**
     * Invoke the filter to check if the value matches.
     */
    final public function __invoke(mixed $value): bool
    {
        $this->value = $value;

        $handler = $this->values()->firstOrFail(...);

        return $this->get(...) |> Value::attempt($handler)->succeeded(...);
    }

    /**
     * Get the result of checking the value.
     */
    abstract protected function get(mixed $value): bool;

    /**
     * Get the current value being filtered.
     */
    protected function value(): mixed
    {
        return $this->value;
    }

    /**
     * Get the collection of values to match against.
     *
     * @return \Mpietrucha\Utility\Collection<int, mixed>
     */
    protected function values(): Collection
    {
        return $this->values = $this->values |> Collection::wrap(...);
    }
}
