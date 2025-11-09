<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Str;
use Symfony\Component\Process\Process;

class Fd extends None
{
    /**
     * Generate a snapshot hash using the fd command-line tool.
     */
    public function get(string $input, ?string $algorithm = null): ?string
    {
        if (Filesystem::not()->exists($input)) {
            return null;
        }

        $process = $this->command($input) |> Process::fromShellCommandLine(...);

        $process->run();

        if ($process->isSuccessful() |> Normalizer::not(...)) {
            return null;
        }

        return $process->getOutput() |> Hash::bind($algorithm);
    }

    /**
     * Build the fd command for generating the snapshot.
     */
    protected function command(string $input): string
    {
        return Str::sprintf('fd --type f --type d --type l --full-path %s | sort | b3sum -', $input);
    }
}
