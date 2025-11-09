<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Cwd implements UtilizableInterface
{
    use Utilizable\Strings;

    /**
     * Get the current working directory.
     */
    public static function get(): string
    {
        return static::utilize();
    }

    /**
     * Determine the project root directory by finding composer.json.
     */
    protected static function hydrate(): string
    {
        $cwd = Filesystem::cwd();

        if (Path::build('composer.json', $cwd) |> Filesystem::exists(...)) {
            return $cwd;
        }

        return Path::directory($cwd);
    }
}
