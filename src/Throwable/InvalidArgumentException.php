<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class InvalidArgumentException extends Throwable
{
    protected function __construct(\InvalidArgumentException $throwable = new \InvalidArgumentException)
    {
        parent::__construct($throwable);
    }
}
