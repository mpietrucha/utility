<?php

namespace Mpietrucha\Utility\Forward\Failure;

abstract class Frames
{
    public static function proxied(): int
    {
        return 10;
    }

    public static function unproxied(): int
    {
        return 11;
    }
}
