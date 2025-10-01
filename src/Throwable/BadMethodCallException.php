<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class BadMethodCallException extends \BadMethodCallException implements ThrowableInterface
{
    use Throwable;
}
