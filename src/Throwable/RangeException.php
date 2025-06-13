<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class RangeException extends Throwable
{
    final protected function __construct(\RangeException $throwable = new \RangeException)
    {
        parent::__construct($throwable);
    }
}
