<?php

namespace Mpietrucha\Utility\Utilizer\Contracts;

interface UtilizableInterface
{
    /**
     * Register the utility for use.
     */
    public static function use(): void;

    /**
     * Utilize and return the utility instance or value.
     */
    public static function utilize(): mixed;
}
