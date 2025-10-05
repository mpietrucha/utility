<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;

abstract class Frame
{
    public static function proxy(FrameInterface $frame): bool
    {
        return $frame->internal(ProxyInterface::class);
    }
}
