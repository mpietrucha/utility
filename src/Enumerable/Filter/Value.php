<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

class Value extends None
{
    /**
     * Create a new value filter with optional strict comparison mode.
     */
    public function __construct(mixed $values, protected bool $strict = false)
    {
        parent::__construct($values);
    }

    /**
     * Wrap a value in an array for filtering.
     *
     * @return list<mixed>
     */
    public static function wrap(mixed $value): array
    {
        return Arr::overlap($value);
    }

    /**
     * Check if the current value matches using strict or loose comparison.
     */
    protected function get(mixed $value): bool
    {
        return match (true) {
            $this->loose() => $value == $this->value(),
            $this->strict() => $value === $this->value(),
        };
    }

    /**
     * Determine if strict comparison mode is enabled.
     *
     * @phpstan-assert-if-true false $this->loose()
     *
     * @phpstan-assert-if-false true $this->loose()
     */
    protected function strict(): bool
    {
        return $this->strict;
    }

    /**
     * Determine if loose comparison mode is enabled.
     *
     * @phpstan-assert-if-true false $this->strict()
     *
     * @phpstan-assert-if-false true $this->strict()
     */
    final protected function loose(): bool
    {
        return $this->strict() |> Normalizer::not(...);
    }
}
