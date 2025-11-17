<?php

namespace Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

trait Strings
{
    use Utilizable;

    /**
     * Set the utilizable string value.
     */
    public static function use(?string $utilizable = null): void
    {
        static::utilizable($utilizable);
    }

    /**
     * Hydrate and return an empty string as the initial value.
     */
    protected static function hydrate(): string
    {
        return Str::none();
    }
}
