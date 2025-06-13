<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class BadFunctionCallException extends Throwable
{
    final protected function __construct(\BadFunctionCallException $throwable = new \BadFunctionCallException)
    {
        parent::__construct($throwable);
    }
}
