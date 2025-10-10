<?php

namespace Mpietrucha\Utility\Hash\Exception;

use Mpietrucha\Utility\Throwable\BadMethodCallException;

class HashException extends BadMethodCallException
{
    public function configure(string $algorithm): string
    {
        return 'Hash algorithm `%s` does not exists';
    }
}
