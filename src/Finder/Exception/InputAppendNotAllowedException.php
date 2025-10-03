<?php

namespace Mpietrucha\Utility\Finder\Exception;

use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\BadMethodCallException;

class InputAppendNotAllowedException extends BadMethodCallException
{
    /**
     * @return array{0: string, 1: class-string}
     */
    public function configure(FinderInterface $finder): array
    {
        return [
            '%s::append() method is not allowed in this finder instance',
            Instance::namespace($finder),
        ];
    }
}
