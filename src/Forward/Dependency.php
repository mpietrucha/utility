<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Exception\DependencyException;

class Dependency
{
    /**
     * Resolve the given dependency or throw an exception if unavailable.
     */
    public static function use(string $dependency, string $vendor, string $group): ForwardInterface
    {
        if (Evaluable::callable($dependency)) {
            return Forward::create($dependency);
        }

        DependencyException::for($vendor, $group)->throw();
    }
}
