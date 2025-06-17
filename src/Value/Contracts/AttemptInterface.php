<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface AttemptInterface extends EvaluableInterface
{
    public function __invoke(): ResultInterface;

    public function get(): ResultInterface;

    /**
        @param array<mixed> $arguments
     */
    public function eval(array $arguments): ResultInterface;
}
