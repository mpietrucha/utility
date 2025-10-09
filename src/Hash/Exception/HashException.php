<?php

namespace Mpietrucha\Utility\Hash\Exception;

use ArgumentCountError;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Throwable\RuntimeException;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;
use TypeError;

class HashException extends RuntimeException
{
    public function configure(ResultInterface|Throwable $throwable): string
    {
        if ($throwable instanceof ResultInterface) {
            return $throwable->error() |> $this->configure(...);
        }

        if ($throwable instanceof ArgumentCountError) {
            return 'Hash data is missing';
        }

        if ($throwable instanceof TypeError) {
            return 'Hash data must be a string';
        }

        return Str::after($throwable->getMessage(), 'hash(): ');
    }
}
