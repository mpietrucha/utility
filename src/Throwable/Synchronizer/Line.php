<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Throwable\Enums\Property;
use Mpietrucha\Utility\Type;

class Line extends None
{
    /**
     * Get the throwable property this synchronizer manages.
     */
    public function property(): Property
    {
        return Property::LINE;
    }

    /**
     * Extract the line number value from the given frame.
     */
    public function value(FrameInterface $frame): ?int
    {
        return $frame->line();
    }

    /**
     * Determine if a line number value exists in the given frame.
     */
    public function exists(FrameInterface $frame): bool
    {
        return $this->value($frame) |> Type::integer(...);
    }
}
