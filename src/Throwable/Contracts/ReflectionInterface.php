<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

interface ReflectionInterface extends CreatableInterface, InteractsWithThrowableInterface
{
    public function backtrace(): EnumerableInterface;
}
