<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class OverflowException extends Throwable
{
    final protected function __construct(\OverflowException $throwable = new \OverflowException)
    {
        parent::__construct($throwable);
    }
}
