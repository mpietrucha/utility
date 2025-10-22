<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;

abstract class Cwd
{
    public static function get(): string
    {
        return Filesystem::cwd();
    }
}
