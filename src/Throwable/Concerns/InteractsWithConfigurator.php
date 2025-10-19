<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

use Mpietrucha\Utility\Throwable\Configurator;
use Mpietrucha\Utility\Throwable\Contracts\ConfiguratorInterface;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

/**
 * @internal
 *
 * @phpstan-require-implements \Mpietrucha\Utility\Throwable\Contracts\InteractsWithConfiguratorInterface
 */
trait InteractsWithConfigurator
{
    public static function configurator(): ConfiguratorInterface
    {
        return static::create() |> Configurator::create(...);
    }

    public static function for(mixed ...$arguments): ThrowableInterface
    {
        return static::configurator()->eval($arguments, __FUNCTION__);
    }
}
