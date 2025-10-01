<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class UnexpectedValueException extends \UnexpectedValueException implements ThrowableInterface
{
    use Throwable;
}
