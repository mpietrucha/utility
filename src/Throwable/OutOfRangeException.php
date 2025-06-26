<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class OutOfRangeException extends Throwable
{
    /**
     * Create a wrapped OutOfRangeException instance.
     */
    final protected function __construct(\OutOfRangeException $throwable = new \OutOfRangeException)
    {
        parent::__construct($throwable);
    }
}
