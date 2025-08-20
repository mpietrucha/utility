<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem\Contracts\SnapshotInterface;

abstract class None implements CreatableInterface, SnapshotInterface
{
    use Creatable;
}
