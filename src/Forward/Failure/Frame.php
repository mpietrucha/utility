<?php

namespace Mpietrucha\Utility\Forward\Failure;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Type;

abstract class Frame
{
    public static function proxy(FrameInterface $frame): bool
    {
        $namespace = $frame->namespace();

        if (Type::null($namespace)) {
            return false;
        }

        return Instance::is($namespace, ProxyInterface::class);
    }
}
