<?php

namespace Mpietrucha\Utility\Exception;

class OutOfBoundsException extends Throwable
{
    final protected function __construct(\OutOfBoundsException $throwable = new \OutOfBoundsException)
    {
        parent::__construct($throwable);
    }
}
