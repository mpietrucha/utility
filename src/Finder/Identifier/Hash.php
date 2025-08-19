<?php

namespace Mpietrucha\Utility\Finder\Identifier;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Instance;

class Hash implements CreatableInterface, IdentifierInterface
{
    use Creatable;

    public function identify(FinderInterface $finder, ?string $algorithm = null, ?callable $serialize = null): string
    {
        return Instance::hash($finder, $algorithm, $serialize);
    }
}
