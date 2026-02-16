<?php

namespace Mpietrucha\Utility\Latch\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class LatchAcquiredException extends RuntimeException
{
    /**
     * Configure the exception message for the given indicator.
     */
    public function configure(string $indicator): string
    {
        return 'Latch `%s` is already acquired';
    }
}
