<?php

namespace Mpietrucha\Utility\Filesystem\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class UnavailableSystemCwdException extends RuntimeException
{
    public function __construct()
    {
        /** @phpstan-ignore-next-line expr.resultUnused */
        'System current working directory is unavailable' |> $this->message(...);
    }
}
