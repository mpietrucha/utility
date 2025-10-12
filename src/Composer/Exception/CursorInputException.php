<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class CursorInputException extends InvalidArgumentException
{
    public function configure(string $input): string
    {
        return '`%s` must be a file path to an existing cursor input file';
    }
}
