<?php

namespace Mpietrucha\Utility\Value\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Throwable;

interface AttemptInterface extends ArrayableInterface
{
    public function response(): mixed;

    public function throwable(): ?Throwable;

    public function succeeded(): bool;

    public function failed(): bool;
}
