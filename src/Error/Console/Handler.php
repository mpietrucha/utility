<?php

namespace Mpietrucha\Utility\Error\Console;

use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use NunoMaduro\Collision\Provider;

final class Handler implements HandlerInterface
{
    /**
     * Register the error handling provider for console errors.
     */
    public static function register(): void
    {
        new Provider()->register();
    }
}
