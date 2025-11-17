<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface InteractsWithConfiguratorInterface
{
    /**
     * Get the configurator instance for the throwable.
     */
    public static function configurator(): ConfiguratorInterface;

    /**
     * Create a throwable instance for the given arguments.
     */
    public static function for(mixed ...$arguments): ThrowableInterface;
}
