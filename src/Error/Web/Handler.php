<?php

namespace Mpietrucha\Utility\Error\Web;

use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use Spatie\Ignition\Ignition;

class Handler implements HandlerInterface
{
    /**
     * Register the error handling provider for web errors.
     */
    public static function register(): void
    {
        Ignition::make()->setTheme('dark')->register();
    }
}
