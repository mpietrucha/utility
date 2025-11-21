<?php

namespace Mpietrucha\Utility\Process\Contracts;

/**
 * @phpstan-import-type ProcessEnvironment from \Mpietrucha\Utility\Process\Contracts\ProcessInterface
 */
interface InteractsWithEnvironmentInterface
{
    /**
     * Get the environment variables.
     *
     * @return ProcessEnvironment
     */
    public static function get(): array;

    /**
     * Get the default environment value or variables.
     *
     * @return string|ProcessEnvironment
     */
    public static function default(): array|string;
}
