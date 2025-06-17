<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface PipeEvaluationInterface extends EvaluationInterface
{
    public function value(): mixed;
}
