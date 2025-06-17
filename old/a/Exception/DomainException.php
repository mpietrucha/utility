<?php

namespace Mpietrucha\Utility\Exception;

class DomainException extends Throwable
{
    final protected function __construct(\DomainException $throwable = new \DomainException)
    {
        parent::__construct($throwable);
    }
}
