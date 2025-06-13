<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface EvaluableInterface
{
    public function evaluable(): mixed;

    public function supported(): bool;

    public function unsupported(): bool;
}
