<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Throwable\Property;
use Mpietrucha\Utility\Type;

class File extends None
{
    public function property(): Property
    {
        return Property::FILE;
    }

    public function value(FrameInterface $frame): ?string
    {
        return $frame->file();
    }

    public function exists(FrameInterface $frame): bool
    {
        return $this->value($frame) |> Type::string(...);
    }
}
