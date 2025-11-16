<?php

namespace Mpietrucha\Utility\Filesystem\Snapshot;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Process;
use Mpietrucha\Utility\Str;

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

        $process = Process::pipe([
            Str::sprintf('fd --type f --type d --type l --full-path %s', $input),
            'sort',
            'b3sum',
        ]);

        if ($process->failed()) {
            return null;
        }

        return $process->output() |> Hash::bind($algorithm);
    }
}
