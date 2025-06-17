<?php

namespace Mpietrucha\Utility\Exception;

class OverflowException extends Throwable
{
    final protected function __construct(\OverflowException $throwable = new \OverflowException)
    {
        parent::__construct($throwable);
    }
}
