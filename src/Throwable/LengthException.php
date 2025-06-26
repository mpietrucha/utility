<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class LengthException extends Throwable
{
    /**
     * Create a wrapped LengthException instance.
     */
    final protected function __construct(\LengthException $throwable = new \LengthException)
    {
        parent::__construct($throwable);
    }
}
