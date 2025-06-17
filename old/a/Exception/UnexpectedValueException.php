<?php

namespace Mpietrucha\Utility\Exception;

class UnexpectedValueException extends Throwable
{
    final protected function __construct(\UnexpectedValueException $throwable = new \UnexpectedValueException)
    {
        parent::__construct($throwable);
    }
}
