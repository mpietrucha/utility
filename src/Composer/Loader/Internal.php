<?php

namespace Mpietrucha\Utility\Composer\Loader;

use Composer\Autoload\ClassLoader;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Composer\Exception\ComposerLoaderException;
use Mpietrucha\Utility\Composer\Loader;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Type;

class Internal extends Loader implements CompatibleInterface
{
    use Compatible;

    /**
     * Create a new internal loader for the given Composer class loader.
     */
    public function __construct(protected ClassLoader $adapter)
    {
    }

    /**
     * Load the Composer autoloader for the given working directory.
     */
    public static function load(string $cwd): static
    {
        static::incompatible($cwd) && ComposerLoaderException::for($cwd)->throw();

        $vendor = static::vendor($cwd);

        return Arr::get(static::adapters(), $vendor) |> static::create(...);
    }

    /**
     * Determine if a namespace exists in the Composer autoloader.
     */
    public function exists(string $namespace): bool
    {
        return $this->adapter()->findFile($namespace) |> Type::string(...);
    }

    /**
     * Find the file path for the given namespace.
     */
    public function file(string $namespace): ?string
    {
        return $this->adapter()->findFile($namespace) ?: null;
    }

    /**
     * Find the namespace for the given file path.
     */
    public function namespace(string $file): ?string
    {
        $map = $this->adapter()->getClassMap();

        /** @var null|string */
        return Arr::search($map, $file);
    }

    /**
     * Get the Composer class loader adapter.
     */
    protected function adapter(): ClassLoader
    {
        return $this->adapter;
    }

    /**
     * Get all registered Composer class loaders.
     *
     * @return array<string, \Composer\Autoload\ClassLoader>
     */
    protected static function adapters(): array
    {
        return ClassLoader::getRegisteredLoaders();
    }

    /**
     * Get the vendor directory path for the given working directory.
     */
    protected static function vendor(string $cwd): string
    {
        return Path::finish($cwd, 'vendor');
    }

    /**
     * Determine if the working directory is compatible with internal loading.
     */
    protected static function compatibility(string $cwd): bool
    {
        $vendor = static::vendor($cwd);

        return Arr::exists(static::adapters(), $vendor);
    }
}
