<?php

namespace Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

trait Strings
{
    use Utilizable;

    public static function use(?string $utilizable = null): void
    {
        static::utilizable($utilizable);
    }

    protected static function hydrate(): string
    {
        return Str::none();
    }
}
