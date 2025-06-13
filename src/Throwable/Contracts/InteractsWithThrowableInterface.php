<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Throwable;

interface InteractsWithThrowableInterface
{
    public function value(): Throwable;
}
