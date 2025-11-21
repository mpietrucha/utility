<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
interface ConfiguratorInterface
{
    /**
     * Create a configurator for the given throwable.
     */
    public static function for(ThrowableInterface $throwable, ?string $configurator = null): static;

    /**
     * Set the default configurator class.
     */
    public static function use(string $default): void;

    /**
     * Get the default configurator class.
     */
    public static function default(): string;

    /**
     * Get the throwable being configured.
     */
    public function throwable(): ThrowableInterface;

    /**
     * Get the configurator class name.
     */
    public function configurator(): string;

    /**
     * Get the forward instance for the configurator.
     */
    public function forward(?string $method = null): ForwardInterface;

    /**
     * Evaluate the configurator with the given arguments.
     *
     * @param  MixedArray  $arguments
     */
    public function eval(array $arguments, ?string $method = null): ThrowableInterface;
}
