<?php

namespace Mpietrucha\Utility\Enumerable\Filter;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;

class Value extends None
{
    public function __construct(mixed $values, protected bool $strict = false)
    {
        parent::__construct($values);
    }

    /**
     * @return list<mixed>
     */
    public static function wrap(mixed $value): array
    {
        return Arr::overlap($value);
    }

    protected function get(mixed $value): bool
    {
        return match (true) {
            $this->loose() => $value == $this->value(),
            $this->strict() => $value === $this->value(),
        };
    }

    /**
     * @phpstan-assert-if-true false $this->loose()
     *
     * @phpstan-assert-if-false true $this->loose()
     */
    protected function strict(): bool
    {
        return $this->strict;
    }

    /**
     * @phpstan-assert-if-true false $this->strict()
     *
     * @phpstan-assert-if-false true $this->strict()
     */
    final protected function loose(): bool
    {
        return $this->strict() |> Normalizer::not(...);
    }
}
