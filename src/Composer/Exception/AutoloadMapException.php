<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class AutoloadMapException extends InvalidArgumentException
{
    public function configure(string $input): string
    {
        return '`%s` must be a file path to an existing composer autoload map file';
    }
}
