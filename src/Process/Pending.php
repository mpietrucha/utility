<?php

namespace Mpietrucha\Utility\Process;

use Fork\Illuminate\Process\PendingProcess;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Pending extends PendingProcess implements CreatableInterface
{
    use Creatable;
}
