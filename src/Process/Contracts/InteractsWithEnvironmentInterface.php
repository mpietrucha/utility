<?php

namespace Mpietrucha\Utility\Process\Contracts;

interface InteractsWithEnvironmentInterface
{
    /**
     * @return array<string, string>
     */
    public static function get(): array;

    /**
     * @return string|array<string, string>
     */
    public static function default(): array|string;
}
