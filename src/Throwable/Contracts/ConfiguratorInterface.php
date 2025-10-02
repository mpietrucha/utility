<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;

interface ConfiguratorInterface
{
    public static function for(ThrowableInterface $throwable, ?string $configurator = null): static;

    public static function use(string $default): void;

    public static function default(): string;

    public function throwable(): ThrowableInterface;

    public function configurator(): string;

    public function forward(?string $method = null): ForwardInterface;

    /**
     * @param  array<int|string, mixed>  $arguments
     */
    public function eval(array $arguments, ?string $method = null): ThrowableInterface;
}
