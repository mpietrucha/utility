<?php

namespace Mpietrucha\Utility\Contracts;

interface PipeableInterface
{
    /**
     * Pass the current instance through the given evaluable callback,
     * optionally with additional arguments, and return the transformed result.
     */
    public function pipe(mixed $evaluable, mixed ...$arguments): mixed;
}
