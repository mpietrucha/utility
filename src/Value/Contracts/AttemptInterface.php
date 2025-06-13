<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface AttemptInterface extends EvaluableInterface
{
    public function __invoke(): ResultInterface;

    public function get(): ResultInterface;

    public function eval(array $arguments): ResultInterface;
}
