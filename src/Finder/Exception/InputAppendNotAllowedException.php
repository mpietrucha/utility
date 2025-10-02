<?php

namespace Mpietrucha\Utility\Finder\Exception;

use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Throwable\BadMethodCallException;

class InputAppendNotAllowedException extends BadMethodCallException
{
    public function configure(FinderInterface $finder): string
    {
        return '%s::append() method is not allowed in this finder instance';
    }
}
