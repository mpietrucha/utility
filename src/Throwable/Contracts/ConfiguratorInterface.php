<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface ConfiguratorInterface
{
    public static function for(ThrowableInterface $throwable, ?string $configurator = null): static;

    public function configurator(): string;

    public function throwable(): ThrowableInterface;

    /**
    * @param array<int|string, mixed> $arguments
    */
    public function eval(array $arguments, ?string $method = null): ThrowableInterface;
}
