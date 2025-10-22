<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Cwd implements UtilizableInterface
{
    use Utilizable\Strings;

    public static function get(): string
    {
        return static::utilize();
    }

    protected static function hydrate(): string
    {
        $cwd = Filesystem::cwd();

        if (Filesystem::exists($cwd, 'composer.json')) {
            return $cwd;
        }

        return Path::directory($cwd);
    }
}
