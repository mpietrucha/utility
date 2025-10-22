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

class Composer extends Loader implements CompatibleInterface
{
    use Compatible;

    public function __construct(protected ClassLoader $adapter)
    {
    }

    public static function load(string $cwd): static
    {
        static::incompatible($cwd) && ComposerLoaderException::for($cwd)->throw();

        $vendor = static::vendor($cwd);

        return Arr::get(static::adapters(), $vendor) |> static::create(...);
    }

    public function exists(string $namespace): bool
    {
        return $this->adapter()->findFile($namespace) |> Type::string(...);
    }

    public function file(string $namespace): ?string
    {
        return $this->adapter()->findFile($namespace) ?: null;
    }

    public function namespace(string $file): ?string
    {
        $map = $this->adapter()->getClassMap();

        /** @var null|string */
        return Arr::search($map, $file);
    }

    protected function adapter(): ClassLoader
    {
        return $this->adapter;
    }

    /**
     * @return array<string, \Composer\Autoload\ClassLoader>
     */
    protected static function adapters(): array
    {
        return ClassLoader::getRegisteredLoaders();
    }

    protected static function vendor(string $cwd): string
    {
        return Path::finish($cwd, 'vendor');
    }

    protected static function compatibility(string $cwd): bool
    {
        $vendor = static::vendor($cwd);

        return Arr::exists(static::adapters(), $vendor);
    }
}
