<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Composer\Adapter;
use Mpietrucha\Utility\Composer\Autoload;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Symfony\Component\Console\Output\OutputInterface;

class Composer implements ComposerInterface
{
    use Utilizable\Strings, Wrappable;

    protected ?Adapter $adapter = null;

    protected ?AutoloadInterface $autoload = null;

    protected static ?ComposerInterface $default = null;

    public function __construct(protected ?string $cwd = null)
    {
    }

    public static function default(): ComposerInterface
    {
        return static::utilize() |> static::create(...);
    }

    public static function get(): ComposerInterface
    {
        return static::$default ??= static::default();
    }

    public function cwd(): ?string
    {
        return $this->cwd;
    }

    public function autoload(): AutoloadInterface
    {
        return $this->autoload ??= Autoload::default($this);
    }

    public function binary(?string $name = null): array
    {
        return $this->adapter()->findComposer($name);
    }

    public function file(): string
    {
        return $this->adapter()->findComposerFile();
    }

    public function exists(string $package): bool
    {
        return $this->adapter()->hasPackage($package);
    }

    final public function unexists(string $package): bool
    {
        return $this->exists($package) |> Normalizer::not(...);
    }

    public function configure(callable $callback): void
    {
        $this->adapter()->modify($callback);
    }

    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->requirePackages(
            static::normalize($packages),
            $dev,
            $output,
            $binary
        );
    }

    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        return $this->adapter()->removePackages(
            static::normalize($packages),
            $dev,
            $output,
            $binary
        );
    }

    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        return $this->adapter()->dumpAutoloads(static::normalize($extra), $binary);
    }

    public function optimize(?string $binary = null): int
    {
        return $this->adapter()->dumpOptimized($binary);
    }

    protected function adapter(): Adapter
    {
        return $this->adapter ??= $this->cwd() |> Adapter::create(...);
    }

    /**
     * @param  null|string|list<string>  $value
     * @return list<string>
     */
    protected static function normalize(null|array|string $value): array
    {
        return Normalizer::array($value);
    }

    protected static function hydrate(): ?string
    {
        return Filesystem::cwd();
    }
}
