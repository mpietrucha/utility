<?php

namespace Mpietrucha\Utility\Value\Contracts;

use Mpietrucha\Utility\Exception\Contracts\TransformerInterface;
use Throwable;

interface RescueResponseInterface
{
    public function value(): mixed;

    public function throwable(): ?Throwable;

    public function succeeded(): bool;

    public function failed(): bool;

    public function transformer(): ?TransformerInterface;
}
