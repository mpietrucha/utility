<?php

namespace Mpietrucha\Utility\Value\Contracts;

interface PipeInterface extends EvaluationInterface
{
    /**
     * Get the initial value that will be passed through the pipeline.
     */
    public function value(): mixed;
}
