<?php

namespace Mpietrucha\Utility\Forward\Failure;

abstract class Frames
{
    /**
     * Get the number of frames to skip when the forward call is proxied.
     */
    public static function proxied(): int
    {
        return 10;
    }

    /**
     * Get the number of frames to skip when the forward call is not proxied.
     */
    public static function unproxied(): int
    {
        return 11;
    }
}
