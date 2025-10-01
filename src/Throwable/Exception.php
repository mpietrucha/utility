<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\Throwable;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

class Exception extends \Exception implements ThrowableInterface
{
    use Throwable;
}
