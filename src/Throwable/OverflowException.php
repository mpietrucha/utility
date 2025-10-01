<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class OverflowException extends \OverflowException implements ThrowableInterface
{
    use Throwable;
}
