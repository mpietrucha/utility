<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface EvaluationInterface
{
    public function __invoke(): mixed;

    public function valid(): bool;

    public function invalid(): bool;

    public function get(): mixed;

    public function eval(array $arguments): mixed;
}
