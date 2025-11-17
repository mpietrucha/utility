<?php

namespace Mpietrucha\Utility\Process;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Process\Contracts\InteractsWithEnvironmentInterface;
use Mpietrucha\Utility\Process\Environment\Path;

abstract class Environment implements InteractsWithEnvironmentInterface
{
    /**
     * Get the environment variables array.
     */
    public static function get(): array
    {
        return [
            static::default(),
            Path::get(),
        ] |> Arr::collapse(...);
    }

    /**
     * Get the default environment variables from the system.
     */
    public static function default(): array
    {
        return getenv();
    }
}
