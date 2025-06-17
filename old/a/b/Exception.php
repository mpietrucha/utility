<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Exception\Throwable;

class Exception extends Throwable
{
    final protected function __construct(\Exception $throwable = new \Exception)
    {
        parent::__construct($throwable);
    }
}
