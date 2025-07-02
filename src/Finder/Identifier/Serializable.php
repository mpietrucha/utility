<?php

namespace Mpietrucha\Utility\Finder\Identifier;

use Closure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Instance;

class Serializable implements CreatableInterface, IdentifierInterface
{
    use Creatable;

    public function identify(FinderInterface $finder, ?Closure $serialize = null, ?Closure $hash = null): string
    {
        return Instance::serialize($finder, $serialize, $hash ?? Hash::md5(...));
    }
}
