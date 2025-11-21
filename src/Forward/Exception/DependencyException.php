<?php

namespace Mpietrucha\Utility\Forward\Exception;

use Mpietrucha\Utility\Throwable\RuntimeException;

class DependencyException extends RuntimeException
{
    /**
     * Configure the exception message with vendor and group information.
     *
     * @return list<string>
     */
    public function configure(string $vendor, string $group): array
    {
        return [
            'In order to use %s install `%s` package',
            $group,
            $vendor,
        ];
    }
}
