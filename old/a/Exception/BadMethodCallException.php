<?php

namespace Mpietrucha\Utility\Exception;

class BadMethodCallException extends Throwable
{
    final protected function __construct(\BadMethodCallException $throwable = new \BadMethodCallException)
    {
        parent::__construct($throwable);
    }
}
