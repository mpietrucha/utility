<?php

namespace Mpietrucha\Utility\Exception;

class InvalidArgumentException extends Throwable
{
    protected function __construct(\InvalidArgumentException $throwable = new \InvalidArgumentException)
    {
        parent::__construct($throwable);
    }
}
