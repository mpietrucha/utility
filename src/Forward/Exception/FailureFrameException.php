<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Throwable\LogicException;

class FailureFrameException extends LogicException
{
    public function initialize(): void
    {
        'Cannot determine frame for forward failure' |> $this->message(...);
    }
}
