<?php

namespace Mpietrucha\Utility\Stream\Contracts;

interface InteractsWithFilesystemInterface
{
    /**
     * Open a stream from the given URI and mode.
     */
    public static function open(string $uri, ?string $mode = null): StreamInterface;

    /**
     * Create a temporary stream.
     */
    public static function temporary(): StreamInterface;

    /**
     * Create a temporary ephemeral stream.
     */
    public static function ephemeral(?string $name = null): StreamInterface;
}
