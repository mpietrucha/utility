<?php

namespace Mpietrucha\Utility\Process\Contracts;

/**
 * @phpstan-import-type Environment from \Mpietrucha\Utility\Process\Contracts\ProcessInterface
 */
interface InteractsWithEnvironmentInterface
{
    /**
     * Get the environment variables.
     *
     * @return Environment
     */
    public static function get(): array;

    /**
     * Get the default environment value or variables.
     *
     * @return string|Environment
     */
    public static function default(): array|string;
}
