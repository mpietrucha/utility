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

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function explode(mixed $delimiter, mixed $limit = PHP_INT_MAX): EnumerableInterface
    {
        return Collection::create(parent::explode($delimiter));
    }
}
