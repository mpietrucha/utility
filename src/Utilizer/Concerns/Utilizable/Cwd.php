<?php

namespace Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

use Mpietrucha\Utility\Filesystem;

trait Cwd
{
    use Strings;

    protected static function hydrate(): string
    {
        return Filesystem::cwd();
    }
}
