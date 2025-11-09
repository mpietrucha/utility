<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer;
use Mpietrucha\Utility\Composer\Concerns\InteractsWithAutoloader;
use Mpietrucha\Utility\Composer\Concerns\InteractsWithLoader;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Composer\Contracts\LoaderInterface;
use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

class Autoload extends Loader implements AutoloadInterface
{
    use InteractsWithAutoloader, InteractsWithLoader, Utilizable\Cwd;

    /**
     * Create a new autoload instance with the given loader and composer.
     */
    protected function __construct(protected LoaderInterface $loader, protected ComposerInterface $composer)
    {
    }

    /**
     * Load the autoload configuration from the given composer instance.
     */
    public static function load(ComposerInterface|string $composer): static
    {
        $composer = Composer::wrap($composer);

        return static::create($composer->cwd() |> static::get(...), $composer);
    }

    /**
     * Create a default autoload instance using the current working directory.
     */
    public static function default(null|ComposerInterface|string $composer = null): static
    {
        $composer ??= static::utilize();

        return Composer::wrap($composer) |> static::load(...);
    }

    /**
     * Get the class loader instance.
     */
    public function loader(): LoaderInterface
    {
        return $this->loader;
    }

    /**
     * Get the composer instance.
     */
    public function composer(): ComposerInterface
    {
        return $this->composer;
    }

    /**
     * Get the namespace for the given file path.
     */
    public function namespace(string $file, bool $canonicalized = false): ?string
    {
        $namespace = $this->loader()->namespace($file);

        if (Type::null($namespace)) {
            return null;
        }

        return $canonicalized ? Path::canonicalize($namespace) : $namespace;
    }
}
