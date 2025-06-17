<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

interface ReflectionInterface extends CreatableInterface, InteractsWithThrowableInterface
{
    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    public function backtrace(): EnumerableInterface;
}
