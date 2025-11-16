<?php

namespace Mpietrucha\Utility\Process\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface EnvironmentInterface extends InteractsWithEnvironmentInterface, UtilizableInterface
{
    public static function name(): string;

    public static function value(): string;

    public static function default(): string;
}
