<?php

namespace Mpietrucha\Utility\Value\Contracts;

use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Throwable;

interface ResultInterface
{
    public function value(): mixed;

    public function failure(): ?Throwable;

    public function succeeded(): bool;

    public function failed(): bool;

    public function throwable(): ?ThrowableInterface;
}
