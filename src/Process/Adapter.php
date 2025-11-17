<?php

namespace Mpietrucha\Utility\Process;

use Fork\Illuminate\Process\Factory;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Process;

class Adapter extends Factory implements CreatableInterface
{
    use Creatable;

    /**
     * Create a new process instance with default configuration including current working directory and environment.
     *
     * @phpstan-ignore-next-line method.childReturnType
     */
    public function newPendingProcess(): Process
    {
        $process = Process::create();

        Cwd::get() |> $process->path(...);

        Environment::get() |> $process->env(...);

        return $process;
    }
}
