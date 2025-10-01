<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

trait InteractsWithThrowable
{
    use InteractsWithReflection;

    /**
     * Throw the underhood throwable
     *
     * @throws \Throwable
     */
    public function throw(): never
    {
        throw $this->value();
    }
}
