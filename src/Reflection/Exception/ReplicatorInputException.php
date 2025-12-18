<?php

namespace Mpietrucha\Utility\Reflection\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ReplicatorInputException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Replicator input must be an object or class name' |> $this->message(...);
    }
}
