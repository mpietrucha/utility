<?php

namespace Mpietrucha\Utility\Finder\Snapshot;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\SnapshotInterface;

class None implements CreatableInterface, SnapshotInterface
{
    use Creatable;

    /**
     * Get the snapshot for the given input path.
     */
    public function get(string $input): ?string
    {
        return null;
    }

    /**
     * Determine if the snapshot for the given input has expired.
     */
    public function expired(string $input): bool
    {
        return false;
    }
}
