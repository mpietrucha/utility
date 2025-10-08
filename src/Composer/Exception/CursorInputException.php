<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class CursorInputException extends InvalidArgumentException
{
    public function configure(string $input): string
    {
        return 'Cursor input file `%s` does not exists';
    }
}
