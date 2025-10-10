<?php

namespace Mpietrucha\Utility\Utilizer\Contracts;

interface UtilizableInterface
{
    public static function use(): void;

    public static function utilize(): mixed;
}
