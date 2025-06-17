<?php

namespace Mpietrucha\Utility\Exception;

class UnderflowException extends Throwable
{
    final protected function __construct(\UnderflowException $throwable = new \UnderflowException)
    {
        parent::__construct($throwable);
    }
}
