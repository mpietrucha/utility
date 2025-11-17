<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Fork\Alias;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload;
use Mpietrucha\Utility\Fork\Contracts\InteractsWithAutoloadInterface;
use Mpietrucha\Utility\Fork\Contracts\OverrideInterface;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Override;
use Mpietrucha\Utility\Fork\Storage;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Fork implements InteractsWithAutoloadInterface, UtilizableInterface
{
    /**
     * @use \Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload<string, \Mpietrucha\Utility\Fork\Contracts\OverrideInterface>
     */
    use InteractsWithAutoload, Utilizable;

    /**
     * Set the storage instance to use for forked classes.
     */
    public static function use(?StorageInterface $storage = null): void
    {
        static::utilizable($storage);
    }

    /**
     * Load multiple overrides into the fork autoloader.
     *
     * @param  list<string|\Mpietrucha\Utility\Fork\Contracts\OverrideInterface>  $overrides
     */
    public static function load(array $overrides): void
    {
        static::add(...) |> Collection::create($overrides)->each(...);
    }

    /**
     * Add a transformer to the fork autoloader.
     */
    public static function add(OverrideInterface|string $override): void
    {
        static::bootstrap();

        $override = Override::wrap($override);

        Alias::override($override);

        static::autoload()->put($override->namespace(), $override);
    }

    /**
     * Require the forked file for the given namespace.
     */
    protected static function require(string $namespace): void
    {
        $override = static::autoload()->get($namespace) ?? Override::runtime($namespace);

        if (Type::null($override)) {
            return;
        }

        if ($override->file() |> Filesystem::unexists(...)) {
            return;
        }

        static::storage()->store($override) |> Filesystem::requireOnce(...);
    }

    /**
     * Get the storage instance for forked classes.
     */
    protected static function storage(): StorageInterface
    {
        return static::utilize();
    }

    /**
     * Create the default storage instance.
     */
    protected static function hydrate(): StorageInterface
    {
        return Storage::create();
    }
}
