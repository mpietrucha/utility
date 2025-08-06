<?php

namespace Mpietrucha\Utility\Finder\Identifier;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Instance;

class Serializable implements CreatableInterface, IdentifierInterface
{
    use Creatable;

    public function identify(FinderInterface $finder, ?callable $hash = null, ?callable $serialize = null): string
    {
        return Instance::hash($finder, $hash, $serialize);
    }
}
