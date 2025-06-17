<?php

namespace Mpietrucha\Utility\Exception;

class RangeException extends Throwable
{
    final protected function __construct(\RangeException $throwable = new \RangeException)
    {
        parent::__construct($throwable);
    }
}
