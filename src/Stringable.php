<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Conditionable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\ConditionableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

class Stringable extends \Illuminate\Support\Stringable implements ConditionableInterface, CreatableInterface, PipeableInterface, StringableInterface, TappableInterface
{
    use Conditionable, Creatable, Pipeable, Tappable;

    /**
     * Convert the object to its string representation.
     */
    public function __toString(): string
    {
        return parent::__toString();
    }

    /**
     * Get the string value of the object.
     */
    public function toString(): string
    {
        return parent::toString();
    }

    public function toStringable(): static
    {
        return clone $this;
    }

    public function sprintf(mixed ...$arguments): static
    {
        return Str::sprintf($this->toString(), ...$arguments) |> static::create(...);
    }

    public function hash(?string $algorithm = null): static
    {
        return Hash::algorithm($algorithm) |> parent::hash(...);
    }

    public function fits(string $input): bool
    {
        return Str::is($this->toString(), $input);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function explode(mixed $delimiter, mixed $limit = null): EnumerableInterface
    {
        $limit ??= PHP_INT_MAX;

        return parent::explode($delimiter, $limit) |> Collection::create(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function lines(?int $limit = null, ?string $delimiter = null): EnumerableInterface
    {
        $delimiter ??= Str::eol();

        return $this->explode($delimiter, $limit);
    }
}
