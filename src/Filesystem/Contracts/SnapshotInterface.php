<?php

namespace Mpietrucha\Utility\Filesystem\Contracts;

interface SnapshotInterface
{
    /**
     * Get the snapshot hash for the given input.
     */
    public function get(string $input, ?string $algorithm = null): ?string;
}
