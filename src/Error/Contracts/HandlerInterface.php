<?php

namespace Mpietrucha\Utility\Error\Contracts;

interface HandlerInterface
{
    public function adapter(): object;

    public function supported(): bool;

    public function capture(): void;
}
