<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Throwable\Reflection;
use Mpietrucha\Utility\Value\Result;

class Throwable extends Reflection implements ThrowableInterface
{
    /**
     * Throw the underhood throwable
     *
     * @throws \Throwable
     */
    public function throw(): never
    {
        $this->notify();

        throw $this->value();
    }

    /**
     * Notify about the current throwable
     */
    protected function notify(): void
    {
        Result::previous($this);
    }
}
