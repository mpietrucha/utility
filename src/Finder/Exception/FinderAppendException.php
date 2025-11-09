<?php

namespace Mpietrucha\Utility\Finder\Exception;

use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\BadMethodCallException;

class FinderAppendException extends BadMethodCallException
{
    /**
     * Configure the exception with the finder instance that attempted an invalid append operation.
     *
     * @return array{0: string, 1: class-string}
     */
    public function configure(FinderInterface $finder): array
    {
        return [
            'Call to %s::append() method is prohibited in this finder instance',
            Instance::namespace($finder),
        ];
    }
}
