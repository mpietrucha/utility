<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable;

class DomainException extends Throwable
{
    /**
     * Create a wrapped DomainException instance.
     */
    final protected function __construct(\DomainException $throwable = new \DomainException)
    {
        parent::__construct($throwable);
    }
}
