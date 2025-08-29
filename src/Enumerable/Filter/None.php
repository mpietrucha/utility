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

    public function __construct(protected mixed $values)
    {
    }

    final public function __invoke(mixed $value): bool
    {
        $this->value = $value;

        $handler = $this->values()->firstOrFail(...);

        return $this->get(...) |> Value::attempt($handler)->succeeded(...);
    }

    abstract protected function get(mixed $value): bool;

    protected function value(): mixed
    {
        return $this->value;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, mixed>
     */
    protected function values(): Collection
    {
        return $this->values = $this->values |> Collection::bind(...);
    }
}
