<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class DomainException extends Throwable
{
    final protected function __construct(\DomainException $throwable = new \DomainException)
    {
        parent::__construct($throwable);
    }
}
