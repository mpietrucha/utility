<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface EvaluationInterface extends EvaluableInterface
{
    public function __invoke(): mixed;

    public function get(): mixed;

    /**
        @param array<mixed> $arguments
     */
    public function eval(array $arguments): mixed;
}
