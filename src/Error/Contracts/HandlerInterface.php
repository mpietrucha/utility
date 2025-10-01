<?php

namespace Mpietrucha\Utility\Error\Contracts;

interface HandlerInterface
{
    public function provider(): object;

    public function due(): bool;

    public function capture(): void;
}
