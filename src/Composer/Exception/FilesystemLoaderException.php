<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class FilesystemLoaderException extends InvalidArgumentException
{
    public function configure(string $cwd): string
    {
        return 'Path `%s` does not contain a `vendor` directory';
    }
}
