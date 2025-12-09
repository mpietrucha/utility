<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use Mpietrucha\Utility\Error\Frame;
use Mpietrucha\Utility\Error\Handler;
use Mpietrucha\Utility\Error\Level;

abstract class Error
{
    /**
     * Set or get the error reporting level.
     */
    public static function level(?int $level = null): int
    {
        return Level::use($level);
    }

    /**
     * Capture errors using the specified handler.
     */
    public static function capture(?HandlerInterface $handler = null): HandlerInterface
    {
        return Handler::capture($handler);
    }

    /**
     * Get the current error handler instance.
     */
    public static function handler(): HandlerInterface
    {
        return Handler::get();
    }

    /**
     * Get the last error that occurred, if any.
     */
    public static function last(?int $level = null): ?Frame
    {
        $error = error_get_last();

        if (Type::null($error)) {
            return null;
        }

        $frame = Frame::create($error);

        if (Type::null($level)) {
            return $frame;
        }

        return match (true) {
            $level === $frame->level() => $frame,
            default => null
        };
    }
}
