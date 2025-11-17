<?php

namespace Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

use Mpietrucha\Utility\Filesystem;

trait Cwd
{
    use Strings;

    /**
     * Hydrate and return the current working directory as the initial value.
     */
    protected static function hydrate(): string
    {
        return Filesystem\Cwd::get();
    }
}
