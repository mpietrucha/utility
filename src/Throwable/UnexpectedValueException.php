<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class UnexpectedValueException extends Throwable
{
    /**
     * Create a wrapped UnexpectedValueException instance.
     */
    final protected function __construct(\UnexpectedValueException $throwable = new \UnexpectedValueException)
    {
        parent::__construct($throwable);
    }
}
