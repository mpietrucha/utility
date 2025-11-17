<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Throwable\LogicException;

class FailureFrameException extends LogicException
{
    /**
     * Initialize the exception with a default message.
     */
    public function initialize(): void
    {
        'Cannot determine frame for forward failure' |> $this->message(...);
    }
}
