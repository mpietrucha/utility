<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface PipeInterface extends EvaluationInterface
{
    public function transformer(): mixed;

    public function value(): mixed;
}
