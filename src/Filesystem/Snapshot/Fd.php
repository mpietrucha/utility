<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Symfony\Component\Process\Process;

class Fd extends None
{
    public function get(string $input, ?string $algorithm = null): ?string
    {
        if (Filesystem::not()->present($input)) {
            return null;
        }

        $process = $this->command($input) |> Process::fromShellCommandLine(...);

        $process->run();

        if ($process->isSuccessful() |> Normalizer::not(...)) {
            return null;
        }

        return $process->getOutput() |> Hash::bind($algorithm);
    }

    protected function command(string $input): string
    {
        return Str::sprintf('fd --type f --type d --type l --full-path %s | sort | b3sum -', $input);
    }
}
