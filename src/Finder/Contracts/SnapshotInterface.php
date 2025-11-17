<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface SnapshotInterface
{
    /**
     * Get the snapshot for the given input.
     */
    public function get(string $input): ?string;

    /**
     * Determine if the snapshot has expired for the given input.
     */
    public function expired(string $input): bool;
}
