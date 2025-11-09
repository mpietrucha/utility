<?php

namespace Mpietrucha\Utility\Composer\Loader;

use Mpietrucha\Utility\Composer\Exception\FilesystemLoaderException;
use Mpietrucha\Utility\Composer\Loader;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;

class Enumerable extends Loader
{
    /**
     * Create a new enumerable loader from an enumerable adapter.
     *
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>  $adapter
     */
    public function __construct(protected EnumerableInterface $adapter)
    {
    }

    /**
     * Load the Composer class map from the working directory.
     */
    public static function load(string $cwd): static
    {
        $autoload = static::autoload($cwd);

        Filesystem::unexists($autoload) && FilesystemLoaderException::for($cwd)->throw();

        $require = Filesystem::requireOnce(...);

        return LazyCollection::initialize($require, $autoload) |> static::create(...);
    }

    /**
     * Determine if a namespace exists in the class map.
     */
    public function exists(string $namespace): bool
    {
        return $this->adapter()->has($namespace);
    }

    /**
     * Get the file path for the given namespace.
     */
    public function file(string $namespace): ?string
    {
        return $this->adapter()->get($namespace);
    }

    /**
     * Find the namespace for the given file path.
     */
    public function namespace(string $file): ?string
    {
        /** @var null|string */
        return $this->adapter()->search($file);
    }

    /**
     * Get the enumerable adapter containing the class map.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    protected function adapter(): EnumerableInterface
    {
        return $this->adapter;
    }

    /**
     * Get the path to the Composer autoload classmap file.
     */
    protected static function autoload(string $cwd): string
    {
        return Path::build('vendor/composer/autoload_classmap.php', $cwd);
    }
}
