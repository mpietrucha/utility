<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface RescueInterface extends PendingInterface
{
    public function eval(array $arguments): AttemptInterface;

    public function raw(array $arguments): array;
}
