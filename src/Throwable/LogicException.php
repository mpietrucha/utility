<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class LogicException extends Throwable
{
    /**
     * Create a wrapped LogicException instance.
     */
    final protected function __construct(\LogicException $throwable = new \LogicException)
    {
        parent::__construct($throwable);
    }
}
