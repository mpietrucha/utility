<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Value\Attempt;
use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;
use Mpietrucha\Utility\Value\Evaluation;
use Mpietrucha\Utility\Value\Pipe;

abstract class Value
{
    public static function for(mixed $evaluable): EvaluationInterface
    {
        return Evaluation::create($evaluable);
    }

    public static function attempt(mixed $evaluable): AttemptInterface
    {
        return Attempt::create($evaluable);
    }

    public static function pipe(mixed $value, mixed $evaluable): PipeInterface
    {
        return Pipe::create($value, $evaluable);
    }
}
