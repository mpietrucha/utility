<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface RescueEvaluationInterface extends EvaluationInterface
{
    public function eval(array $arguments): RescuedInterface;

    public function raw(array $arguments): array;
}
