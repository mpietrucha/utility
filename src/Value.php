<?php

namespace Mpietrucha\Utility;

use Closure;
use Mpietrucha\Utility\Value\Attempt;
use Mpietrucha\Utility\Value\Contracts\AttemptInterface;
use Mpietrucha\Utility\Value\Contracts\EvaluationInterface;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;
use Mpietrucha\Utility\Value\Evaluation;
use Mpietrucha\Utility\Value\Pipe;

abstract class Value
{
    /**
     * Create a new evaluation from the given value.
     *
     * @return \Mpietrucha\Utility\Value\Evaluation
     */
    public static function for(mixed $evaluable): EvaluationInterface
    {
        return Evaluation::create($evaluable);
    }

    /**
     * Create a new attempted evaluation that captures exceptions.
     *
     * @return \Mpietrucha\Utility\Value\Attempt
     */
    public static function attempt(mixed $evaluable): AttemptInterface
    {
        return Attempt::create($evaluable);
    }

    /**
     * Create a new pipeline that passes the value through the given evaluator.
     *
     * @return \Mpietrucha\Utility\Value\Pipe
     */
    public static function pipe(mixed $value, mixed $evaluable): PipeInterface
    {
        return Pipe::create($value, $evaluable);
    }

    /**
     * @param  array<int|string, mixed>|null  $arguments
     */
    public static function bind(mixed $evaluable, ?array $arguments = null): Closure
    {
        return Evaluation::bind($evaluable, $arguments);
    }
}
