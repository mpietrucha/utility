<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Composer;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Composer\Contracts\CursorInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

class Autoload implements AutoloadInterface, CreatableInterface
{
    use Creatable;

    protected ?ComposerInterface $composer = null;

    protected static ?AutoloadInterface $default = null;

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<array-key, mixed>  $cursor
     */
    protected function __construct(protected EnumerableInterface $cursor, protected ?string $cwd = null)
    {
    }

    public static function load(string $input, ?CursorInterface $cursor = null, ?string $cwd = null): static
    {
        $input = Path::build($input, $cwd);

        $cursor ??= Cursor\Generator::create();

        return static::create($cursor->get($input), $cwd);
    }

    public static function default(?CursorInterface $cursor = null): AutoloadInterface
    {
        return static::load('vendor/composer/autoload_classmap.php', $cursor);
    }

    public static function get(): AutoloadInterface
    {
        return static::$default ??= static::default();
    }

    public function composer(): ComposerInterface
    {
        return $this->composer ??= $this->cwd() |> Composer::create(...);
    }

    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        return $this->composer()->dump($extra, $binary);
    }

    public function optimize(?string $binary = null): int
    {
        return $this->composer()->optimize($binary);
    }

    public function cursor(): EnumerableInterface
    {
        return $this->cursor;
    }

    public function exists(string $namespace): bool
    {
        return $this->cursor()->has($namespace);
    }

    final public function unexists(string $namespace): bool
    {
        return $this->exists($namespace) |> Normalizer::not(...);
    }

    public function file(string $namespace): ?string
    {
        return $this->cursor()->get($namespace) |> static::normalize(...);
    }

    public function namespace(string $file, bool $canonicalized = false): ?string
    {
        $namespace = $this->cursor()->search($file) |> static::normalize(...);

        if (Type::null($namespace)) {
            return null;
        }

        return $canonicalized ? Path::canonicalize($namespace) : $namespace;
    }

    protected function cwd(): ?string
    {
        return $this->cwd;
    }

    protected static function normalize(mixed $value): ?string
    {
        if (Type::not()->string($value)) {
            return null;
        }

        return $value;
    }
}
