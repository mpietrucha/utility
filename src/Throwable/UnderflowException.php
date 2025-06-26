<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class UnderflowException extends Throwable
{
    /**
     * Create a wrapped UnderflowException instance.
     */
    final protected function __construct(\UnderflowException $throwable = new \UnderflowException)
    {
        parent::__construct($throwable);
    }
}
