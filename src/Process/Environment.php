<?php

namespace Mpietrucha\Utility\Process;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Process\Contracts\InteractsWithEnvironmentInterface;
use Mpietrucha\Utility\Process\Environment\Path;

abstract class Environment implements InteractsWithEnvironmentInterface
{
    public static function get(): array
    {
        return [
            static::default(),
            Path::get(),
        ] |> Arr::collapse(...);
    }

    public static function default(): array
    {
        return getenv();
    }
}
