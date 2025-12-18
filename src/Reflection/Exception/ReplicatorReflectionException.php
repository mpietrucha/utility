<?php

namespace Mpietrucha\Utility\Reflection\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ReplicatorReflectionException extends InvalidArgumentException
{
    public function initialize(): void
    {
        'Replicator reflection does not match the given input' |> $this->message(...);
    }
}
