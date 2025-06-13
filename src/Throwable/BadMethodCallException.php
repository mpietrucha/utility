<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class BadMethodCallException extends Throwable
{
    final protected function __construct(\BadMethodCallException $throwable = new \BadMethodCallException)
    {
        parent::__construct($throwable);
    }
}
