<?php

namespace Mpietrucha\Utility\Contracts;

use Mpietrucha\Utility\Forward\Contracts\TapInterface;

interface TappableInterface
{
    public function tap(mixed $tap): TapInterface|TappableInterface;
}
