<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class BadFunctionCallException extends \BadFunctionCallException implements ThrowableInterface
{
    use Throwable;
}
