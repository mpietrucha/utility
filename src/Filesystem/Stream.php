<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Stream as Adapter;
use Mpietrucha\Utility\Stream\Concerns\InteractsWithFilesystem;
use Mpietrucha\Utility\Stream\Contracts\InteractsWithFilesystemInterface;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

abstract class Stream implements InteractsWithFilesystemInterface
{
    use InteractsWithFilesystem;

    public static function temporary(): StreamInterface
    {
        return Temporary::resource() |> Adapter::create(...);
    }
}
