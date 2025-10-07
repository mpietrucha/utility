<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class CursorException extends InvalidArgumentException
{
    public function configure(string $file): string
    {
        return '';
    }
}
