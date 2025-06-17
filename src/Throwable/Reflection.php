<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Throwable\Contracts\ReflectionInterface;
use Throwable;

class Reflection implements ReflectionInterface
{
    use Creatable;

    protected function __construct(protected Throwable $throwable)
    {
    }

    public function value(): Throwable
    {
        return $this->throwable;
    }

    /**
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    public function backtrace(): EnumerableInterface
    {
        return Backtrace::throwable($this);
    }
}
