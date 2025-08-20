<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface SnapshotInterface
{
    public function get(string $input): string;

    public function expired(string $input): bool;
}
