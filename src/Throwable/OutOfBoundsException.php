<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class OutOfBoundsException extends Throwable
{
    final protected function __construct(\OutOfBoundsException $throwable = new \OutOfBoundsException)
    {
        parent::__construct($throwable);
    }
}
