<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

class Autoload implements AutoloadInterface, CreatableInterface
{
    use Creatable, Utilizable\Strings;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>  $map
     */
    protected function __construct(protected EnumerableInterface $map, protected ComposerInterface $composer)
    {
    }

    public static function load(string $input, null|ComposerInterface|string $composer = null): static
    {
        $composer = Composer::wrap($composer);

        $cwd = $composer->cwd();

        return static::create(Autoload\Map::get($input, $cwd), $composer);
    }

    public static function default(null|ComposerInterface|string $composer = null): static
    {
        $input = static::utilize();

        return static::load($input, $composer);
    }

    public function composer(): ComposerInterface
    {
        return $this->composer;
    }

    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        return $this->composer()->dump($extra, $binary);
    }

    public function optimize(?string $binary = null): int
    {
        return $this->composer()->optimize($binary);
    }

    public function map(): EnumerableInterface
    {
        return $this->map;
    }

    public function exists(string $namespace): bool
    {
        return $this->map()->has($namespace);
    }

    final public function unexists(string $namespace): bool
    {
        return $this->exists($namespace) |> Normalizer::not(...);
    }

    public function file(string $namespace): ?string
    {
        return $this->map()->get($namespace) |> static::normalize(...);
    }

    public function namespace(string $file, bool $canonicalized = false): ?string
    {
        $namespace = $this->map()->search($file) |> static::normalize(...);

        if (Type::null($namespace)) {
            return null;
        }

        return $canonicalized ? Path::canonicalize($namespace) : $namespace;
    }

    protected static function normalize(mixed $value): ?string
    {
        return Type::string($value) ? $value : null;
    }

    protected static function hydrate(): string
    {
        return 'vendor/composer/autoload_classmap.php';
    }
}
