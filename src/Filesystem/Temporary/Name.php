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

    public static function delimiter(): string
    {
        return '-';
    }

    public static function default(): string
    {
        return Str::random(32);
    }

    public static function get(?string $name = null, bool $unique = false): string
    {
        $name = static::normalize($name);

        if ($unique) {
            $name = $name . static::default();
        }

        return $name . static::delimiter() . static::hash($name);
    }

    protected static function compatibility(string $name): bool
    {
        $name = static::normalize($name);

        if (Extension::exists($name)) {
            return false;
        }

        $signature = Str::explode($name, static::delimiter());

        return $signature->last() === $signature->first() |> static::hash(...);
    }

    protected static function hash(string $value): string
    {
        return Hash::md5($value);
    }

    protected static function normalize(?string $name = null): string
    {
        return Path::name($name ??= static::default());
    }
}
