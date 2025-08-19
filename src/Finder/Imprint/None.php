<?php

namespace Mpietrucha\Utility\Finder\Imprint;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\ImprintInterface;

class None implements CreatableInterface, ImprintInterface
{
    use Creatable;

    public function get(string $input): string
    {
        return $input;
    }

    public function expired(string $input): bool
    {
        return false;
    }
}
