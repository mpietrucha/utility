<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Throwable;

interface InteractsWithThrowableInterface
{
    /**
     * Get the underlying throwable instance.
     */
    public function value(): Throwable;
}
