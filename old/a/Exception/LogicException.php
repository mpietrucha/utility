<?php

namespace Mpietrucha\Utility\Exception;

class LogicException extends Throwable
{
    final protected function __construct(\LogicException $throwable = new \LogicException)
    {
        parent::__construct($throwable);
    }
}
