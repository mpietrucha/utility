<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use Mpietrucha\Utility\Error\Handler;
use Mpietrucha\Utility\Error\Level;

abstract class Error
{
    public static function level(?int $level = null): int
    {
        return Level::use($level);
    }

    public static function capture(?HandlerInterface $handler = null): HandlerInterface
    {
        return Handler::capture($handler);
    }

    public static function handler(): HandlerInterface
    {
        return Handler::get();
    }
}
