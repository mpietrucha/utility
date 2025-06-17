<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;
use Mpietrucha\Utility\Value\Contracts\PipeEvaluationInterface;
use Mpietrucha\Utility\Value\Contracts\RescueEvaluationInterface;
use Mpietrucha\Utility\Value\Evaluation;
use Mpietrucha\Utility\Value\Pipe;
use Mpietrucha\Utility\Value\Rescue;

abstract class Value
{
    public static function for(mixed $evaluable): EvaluationInterface
    {
        return Evaluation::create($evaluable);
    }

    public static function rescue(mixed $evaluable): RescueEvaluationInterface
    {
        return Rescue::create($evaluable);
    }

    public static function pipe(mixed $value, mixed $evaluable = null): PipeEvaluationInterface
    {
        return Pipe::create($evaluable, $value);
    }
}
