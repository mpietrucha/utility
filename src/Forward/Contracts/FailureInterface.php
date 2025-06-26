<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

interface FailureInterface
{
    /**
     * Get the associated Forward instance being handled.
     */
    public function forward(): ForwardInterface;

    /**
     * Handle a throwable that occurred when forwarding a call to the given method.
     */
    public function handle(ThrowableInterface $throwable, string $to): void;
}
