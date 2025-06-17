<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Value\Contracts\PendingInterface;
use Mpietrucha\Utility\Value\Contracts\PipeInterface;
use Mpietrucha\Utility\Value\Contracts\RescueInterface;
use Mpietrucha\Utility\Value\Pending;
use Mpietrucha\Utility\Value\Pipe;
use Mpietrucha\Utility\Value\Rescue;

abstract class Value
{
    public static function for(mixed $value): PendingInterface
    {
        return Pending::create($value);
    }

    public static function rescue(mixed $value): RescueInterface
    {
        return Rescue::create($value);
    }

    public static function pipe(mixed $value, mixed $transformer = null): PipeInterface
    {
        return Pipe::create($value, $transformer);
    }
}
