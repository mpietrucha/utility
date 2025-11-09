<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ComposerLoaderException extends InvalidArgumentException
{
    /**
     * Configure the exception with the unregistered working directory path.
     */
    public function configure(string $cwd): string
    {
        return 'Path `%s` is not registered as a Composer loader';
    }
}
