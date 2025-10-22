<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

/**
 * @internal
 */
final class RouteableExtension extends WrappableExtension
{
    protected static function class(): string
    {
        return \Mpietrucha\Utility\Contracts\RouteableInterface::class;
    }

    protected static function method(): string
    {
        return 'wrap';
    }

    protected static function property(): string
    {
        return 'routeable';
    }
}
