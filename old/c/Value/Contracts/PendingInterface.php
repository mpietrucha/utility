<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface PendingInterface extends EvaluationInterface
{
    public function evaluable(): mixed;
}
