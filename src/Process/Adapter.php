<?php

namespace Mpietrucha\Utility\Process;

use Illuminate\Process\Factory;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Process;

class Adapter extends Factory implements CreatableInterface
{
    use Creatable;

    /**
     * @phpstan-ignore-next-line method.childReturnType
     */
    public function newPendingProcess(): Process
    {
        $process = Process::create();

        Environment::get() |> $process->env(...);

        Cwd::get() |> $process->path(...);

        return $process;
    }
}
