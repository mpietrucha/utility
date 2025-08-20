<?php

namespace Mpietrucha\Utility\Filesystem\Contracts;

interface SnapshotInterface
{
    public function get(string $input, ?string $algorithm = null): ?string;
}
