<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface PipeInterface extends EvaluationInterface
{
    public function value(): mixed;
}
