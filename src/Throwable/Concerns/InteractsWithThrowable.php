<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface
 */
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
