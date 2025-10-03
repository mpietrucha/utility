<?php

namespace Mpietrucha\Utility\Stream\Concerns;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Stream;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

trait InteractsWithFilesystem
{
    /**
     * Open a stream from the given URI and mode.
     */
    public static function open(string $uri, ?string $mode = null): StreamInterface
    {
        return Filesystem::open($uri, $mode) |> Stream::create(...);
    }

    /**
     * Create a temporary in-memory stream.
     */
    public static function temporary(): StreamInterface
    {
        return static::open('php://temporary');
    }

    /**
     * Create a temporary ephemeralstream.
     */
    public static function ephemeral(?string $name = null): StreamInterface
    {
        return Filesystem::ephemeral($name) |> static::open(...);
    }
}
