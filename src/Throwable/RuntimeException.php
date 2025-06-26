<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class RuntimeException extends Throwable
{
    /**
     * Create a wrapped RuntimeException instance.
     */
    final protected function __construct(\RuntimeException $throwable = new \RuntimeException)
    {
        parent::__construct($throwable);
    }
}
