<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Throwable\Concerns\InteractsWithReflection;
use Mpietrucha\Utility\Throwable\Contracts\ReflectionInterface;

class Reflection implements ReflectionInterface
{
    use InteractsWithReflection;
}
