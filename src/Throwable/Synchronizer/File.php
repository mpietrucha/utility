<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Throwable\Enums\Property;
use Mpietrucha\Utility\Type;

class File extends None
{
    /**
     * Get the throwable property this synchronizer manages.
     */
    public function property(): Property
    {
        return Property::File;
    }

    /**
     * Extract the file value from the given frame.
     */
    public function value(FrameInterface $frame): ?string
    {
        return $frame->file();
    }

    /**
     * Determine if a file value exists in the given frame.
     */
    public function exists(FrameInterface $frame): bool
    {
        return $this->value($frame) |> Type::string(...);
    }
}
