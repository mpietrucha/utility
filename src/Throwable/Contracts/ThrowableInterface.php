<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface ThrowableInterface extends ReflectionInterface
{
    /**
     * Throw the underlying throwable after applying any configured modifications.
     */
    public function throw(): void;
}
