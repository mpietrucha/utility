<?php

namespace Mpietrucha\Utility\Process;

use Illuminate\Process\Factory;
use Illuminate\Process\PendingProcess;
use Mpietrucha\Utility\Filesystem\Cwd;

/**
 * @mixin \Illuminate\Process\PendingProcess
 */
class Adapter extends Factory
{
    public function newPendingProcess(): PendingProcess
    {
        $process = parent::newPendingProcess();

        Cwd::get() |> $process->path(...);

        return Environment::get() |> $process->env(...);
    }
}
