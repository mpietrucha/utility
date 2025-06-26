<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class Exception extends Throwable
{
    /**
     * Create a wrapped Exception instance.
     */
    final protected function __construct(\Exception $throwable = new \Exception)
    {
        parent::__construct($throwable);
    }
}
