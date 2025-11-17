<?php

namespace Mpietrucha\Utility\Process\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface EnvironmentInterface extends InteractsWithEnvironmentInterface, UtilizableInterface
{
    /**
     * Get the environment variable name.
     */
    public static function name(): string;

    /**
     * Get the environment variable value.
     */
    public static function value(): string;

    /**
     * Get the default environment value.
     */
    public static function default(): string;
}
