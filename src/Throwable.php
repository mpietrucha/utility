<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Throwable\Reflection;

class Throwable extends Reflection implements ThrowableInterface
{
    public function throw(): void
    {
        throw $this->value();
    }
}
