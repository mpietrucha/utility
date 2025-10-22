<?php

namespace Mpietrucha\Utility\Composer\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ComposerLoaderException extends InvalidArgumentException
{
    public function configure(string $cwd): string
    {
        return 'Path `%s` is not registered as a Composer loader';
    }
}
