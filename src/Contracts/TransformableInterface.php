<?php

namespace Mpietrucha\Utility\Contracts;

interface TransformableInterface
{
    /**
     * Transform the evaluated transformable value using the given callback.
     */
    public function transform(mixed $evaluable, mixed ...$arguments): mixed;
}
