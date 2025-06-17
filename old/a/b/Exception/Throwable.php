<?php

namespace Mpietrucha\Utility\Exception;

use Mpietrucha\Utility\Exception\Contracts\ThrowableInterface;

abstract class Throwable extends Transformer implements ThrowableInterface
{
    public function throw(): void
    {
        throw $this->get();
    }
}
