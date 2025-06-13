<?php

namespace Mpietrucha\Utility\Contracts;

use Stringable;

interface StringableInterface extends Stringable
{
    public function toString(): string;
}
