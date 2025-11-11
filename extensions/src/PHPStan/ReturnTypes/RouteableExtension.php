<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

/**
 * @internal
 */
final class RouteableExtension extends WrappableExtension
{
    /**
     * Get the class name this extension supports.
     */
    protected static function class(): string
    {
        return \Mpietrucha\Utility\Contracts\RouteableInterface::class;
    }

    /**
     * Get the method name to analyze.
     */
    protected static function method(): string
    {
        return 'wrap';
    }

    /**
     * Get the property name containing the wrapped class.
     */
    protected static function property(): string
    {
        return 'routeable';
    }
}
