<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

interface InteractsWithThrowableInterface extends ReflectionInterface
{
    /**
     * Throw the underlying throwable after applying any configured modifications.
     */
    public function throw(): never;
}
