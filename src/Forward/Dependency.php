<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Exception\DependencyException;
use Mpietrucha\Utility\Instance;

class Dependency
{
    /**
     * Resolve the given dependency or throw an exception if unavailable.
     */
    public static function use(string $dependency, string $vendor, string $group): ForwardInterface
    {
        if (Instance::exists($dependency)) {
            return Forward::create($dependency);
        }

        DependencyException::for($vendor, $group)->throw();
    }
}
