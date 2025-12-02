<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class RuntimeMapException extends InvalidArgumentException
{
    /**
     * Configure the exception with the path missing a vendor directory.
     */
    public function configure(string $cwd): string
    {
        return 'Path `%s` does not contain a `vendor` directory';
    }
}
