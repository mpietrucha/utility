<?php

namespace Mpietrucha\Utility\Exception\Contracts;

use Throwable;

interface InteractsWithThrowableInterface
{
    public function get(): Throwable;
}
