<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class RangeException extends Throwable
{
    /**
     * Create a wrapped RangeException instance.
     */
    final protected function __construct(\RangeException $throwable = new \RangeException)
    {
        parent::__construct($throwable);
    }
}
