<?php

namespace Mpietrucha\Utility\Filesystem\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class UnavailableSystemCwdException extends RuntimeException
{
    /**
     * Initialize the exception with a default message.
     */
    public function initialize(): void
    {
        'System current working directory is unavailable' |> $this->message(...);
    }
}
