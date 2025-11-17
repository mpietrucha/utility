<?php

namespace Mpietrucha\Utility\Filesystem\Temporary;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Filesystem\Extension;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Str;

abstract class Name implements CompatibleInterface
{
    use Compatible;

    /**
     * Get the delimiter used in temporary file names.
     */
    public static function delimiter(): string
    {
        return '-';
    }

    /**
     * Get the default random temporary file name.
     */
    public static function default(): string
    {
        return Str::random(32);
    }

    /**
     * Get a temporary file name with optional uniqueness.
     */
    public static function get(?string $name = null, bool $unique = false): string
    {
        $name = static::normalize($name);

        if ($unique) {
            $name = $name . static::default();
        }

        return $name . static::delimiter() . static::hash($name);
    }

    /**
     * Determine if the given name is a compatible temporary file name.
     */
    protected static function compatibility(string $name): bool
    {
        $name = static::normalize($name);

        if (Extension::exists($name)) {
            return false;
        }

        $signature = Str::explode($name, static::delimiter());

        return $signature->last() === $signature->first() |> static::hash(...);
    }

    /**
     * Generate an MD5 hash of the given value.
     */
    protected static function hash(string $value): string
    {
        return Hash::md5($value);
    }

    /**
     * Normalize the given name to a path basename.
     */
    protected static function normalize(?string $name = null): string
    {
        return Path::name($name ??= static::default());
    }
}
