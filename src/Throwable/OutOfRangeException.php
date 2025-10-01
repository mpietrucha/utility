<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class OutOfRangeException extends \OutOfRangeException implements ThrowableInterface
{
    use Throwable;
}
