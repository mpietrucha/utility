<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;

class Stringable extends \Illuminate\Support\Stringable implements CreatableInterface, StringableInterface
{
    use Creatable;

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
}
