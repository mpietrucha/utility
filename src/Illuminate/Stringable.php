<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;

class Stringable extends \Illuminate\Support\Stringable implements CreatableInterface, StringableInterface
{
    use Creatable;

    public function __toString(): string
    {
        return parent::__toString();
    }

    public function toString(): string
    {
        return parent::toString();
    }
}
