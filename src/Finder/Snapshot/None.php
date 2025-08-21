<?php

namespace Mpietrucha\Utility\Finder\Snapshot;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\SnapshotInterface;

class None implements CreatableInterface, SnapshotInterface
{
    use Creatable;

    public function get(string $input): ?string
    {
        return null;
    }

    public function expired(string $input): bool
    {
        return false;
    }
}
