<?php

namespace Mpietrucha\Utility\Exception;

class OutOfRangeException extends Throwable
{
    final protected function __construct(\OutOfRangeException $throwable = new \OutOfRangeException)
    {
        parent::__construct($throwable);
    }
}
