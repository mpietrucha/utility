<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Throwable\Concerns\InteractsWithThrowable;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Mpietrucha\Utility\Throwable\Reflection;

class Throwable extends Reflection implements InteractsWithThrowableInterface
{
    use InteractsWithThrowable;
}
