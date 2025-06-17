<?php

interface EvaluableInterface extends InteractsWithDestinationInterface
{
    public function __invoke(string $method, array $arguments): mixed;

    public function instantiated(): bool;

    public function uninstantiated(): bool;
}
