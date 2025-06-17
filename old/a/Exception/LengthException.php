<?php

namespace Mpietrucha\Utility\Exception;

class LengthException extends Throwable
{
    final protected function __construct(\LengthException $throwable = new \LengthException)
    {
        parent::__construct($throwable);
    }
}
