<?php

namespace Mpietrucha\Utility\Hash\Exception;

use Mpietrucha\Utility\Throwable\BadMethodCallException;

class HashAlgorithmException extends BadMethodCallException
{
    public function configure(string $algorithm): string
    {
        return '`%s` is not a supported hash algorithm';
    }
}
