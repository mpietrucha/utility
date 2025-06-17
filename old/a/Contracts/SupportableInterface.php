<?php

namespace Mpietrucha\Utility\Contracts;

interface SupportableInterface
{
    public static function supported(): bool;

    public static function unsupported(): bool;
}
