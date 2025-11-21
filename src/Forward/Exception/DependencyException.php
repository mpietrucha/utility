<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class DependencyException extends RuntimeException
{
    /**
     * Configure the exception message with vendor and group information.
     */
    public function configure(string $vendor, string $group): void
    {
        $this->align(1);

        $this->message('In order to use %s install `%s` package', $group, $vendor);
    }
}
