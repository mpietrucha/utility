<?php

namespace Mpietrucha\Utility\Latch\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class LatchTimeoutException extends RuntimeException
{
    /**
     * Configure the exception message for the given indicator and timeout.
     */
    public function configure(string $indicator, int $timeout): string
    {
        return 'Latch `%s` timed out after %s second(s)';
    }
}
