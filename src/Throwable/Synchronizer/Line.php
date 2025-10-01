<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Throwable\Property;
use Mpietrucha\Utility\Type;

class Line extends None
{
    public function property(): Property
    {
        return Property::LINE;
    }

    public function value(FrameInterface $frame): ?int
    {
        return $frame->line();
    }

    public function exists(FrameInterface $frame): bool
    {
        return $this->value($frame) |> Type::integer(...);
    }
}
