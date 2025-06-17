<?php

namespace Mpietrucha\Utility\Exception;

class RuntimeException extends Throwable
{
    final protected function __construct(\RuntimeException $throwable = new \RuntimeException)
    {
        parent::__construct($throwable);
    }
}
