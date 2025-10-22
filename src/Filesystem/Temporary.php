<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Contracts\InteractsWithTemporaryInterface;
use Mpietrucha\Utility\Filesystem\Temporary\Directory;
use Mpietrucha\Utility\Filesystem\Temporary\Name;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Temporary implements InteractsWithTemporaryInterface, UtilizableInterface
{
    use Utilizable\Strings;

    public static function purge(): void
    {
        static::directory() |> static::flush(...);
    }

    public static function flush(string $directory): void
    {
        $files = Name::compatible(...) |> Finder::uncached()->in($directory)
            ->files()
            ->get()
            ->filter(...);

        $files->each->delete();
    }

    public static function name(?string $name = null, bool $unique = false): string
    {
        return Name::get($name, $unique);
    }

    /**
     * @return resource|null
     */
    public static function resource(): mixed
    {
        return tmpfile() ?: null;
    }

    public static function directory(?string $name = null, bool $unique = false): string
    {
        $directory = static::utilize() |> Directory::get(...);

        if (Type::null($name)) {
            return $directory;
        }

        return static::get($name, $directory, $unique) |> Touch::directory(...);
    }

    public static function file(?string $name, ?string $directory = null, bool $unique = false): string
    {
        return static::get($name, $directory, $unique) |> Touch::file(...);
    }

    public static function get(?string $name = null, ?string $directory = null, bool $unique = false): string
    {
        $temporary = static::build($name, $directory, $unique);

        if ($unique === false) {
            return $temporary;
        }

        if (Filesystem::unexists($temporary)) {
            return $temporary;
        }

        return static::get($name, $directory, $unique);
    }

    protected static function build(?string $name = null, ?string $directory = null, bool $unique = false): string
    {
        $name = static::name($name, $unique);

        return Path::build($name, $directory ?? static::directory());
    }
}
