<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

abstract class Condition implements CreatableInterface
{
    use Creatable;
}
