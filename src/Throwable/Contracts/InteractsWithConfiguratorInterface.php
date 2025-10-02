<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface InteractsWithConfiguratorInterface
{
    public static function configurator(): ConfiguratorInterface;

    public static function for(mixed ...$arguments): ThrowableInterface;
}
