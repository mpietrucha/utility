<?php

namespace Mpietrucha\Utility\Exception;

class BadFunctionCallException extends Throwable
{
    final protected function __construct(\BadFunctionCallException $throwable = new \BadFunctionCallException)
    {
        parent::__construct($throwable);
    }
}
