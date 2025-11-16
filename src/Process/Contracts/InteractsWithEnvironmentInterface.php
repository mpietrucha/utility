<?php

namespace Mpietrucha\Utility\Process\Contracts;

/**
 * @phpstan-import-type Environment from \Mpietrucha\Utility\Process\Contracts\ProcessInterface
 */
interface InteractsWithEnvironmentInterface
{
    /**
     * @return Environment
     */
    public static function get(): array;

    /**
     * @return string|Environment
     */
    public static function default(): array|string;
}
