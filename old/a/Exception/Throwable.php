<?php

namespace Mpietrucha\Utility\Exception;

use Mpietrucha\Utility\Exception\Contracts\ThrowableInterface;

class Throwable extends Builder implements ThrowableInterface
{
    public function throw(): void
    {
        throw $this->get();
    }
}
