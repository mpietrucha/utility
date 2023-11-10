<?php

namespace Mpietrucha\Support\Facade;

use Throwable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class File extends Facadeable
{
    protected static function facadeable(Facade $facade): void
    {
        $facade->source(Filesystem::class);

        $facade->quiet(function (Throwable $exception) {
            return $exception instanceof FileNotFoundException;
        });
    }
}
