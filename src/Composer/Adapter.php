<?php

namespace Mpietrucha\Utility\Composer;

use Illuminate\Support\Composer;
use Mpietrucha\Utility\Composer\Contracts\AdapterInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @property string $workingPath
 */
class Adapter extends Composer implements AdapterInterface
{
    use Wrappable;

    /**
     * @var class-string
     */
    protected static string $wrappable = AdapterInterface::class;

    public function __construct(string $cwd)
    {
        parent::__construct(Filesystem::adapter(), $cwd);
    }

    public function cwd(): string
    {
        return $this->workingPath;
    }

    public function binary(?string $name = null): array
    {
        return $this->findComposer($name);
    }

    public function file(): string
    {
        return $this->findComposerFile();
    }

    public function exists(string $package): bool
    {
        return $this->hasPackage($package);
    }

    final public function unexists(string $package): bool
    {
        return $this->exists($package) |> Normalizer::not(...);
    }

    public function configure(callable $callback): void
    {
        $this->modify($callback);
    }

    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        $packages = static::normalize($packages);

        return $this->requirePackages($packages, $dev, $output, $binary);
    }

    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        $packages = static::normalize($packages);

        return $this->removePackages($packages, $dev, $output, $binary);
    }

    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        $extra = static::normalize($extra);

        return $this->dumpAutoloads($extra, $binary);
    }

    public function optimize(?string $binary = null): int
    {
        return $this->dumpOptimized($binary);
    }

    /**
     * @param  null|string|list<string>  $value
     * @return list<string>
     */
    protected static function normalize(null|array|string $value): array
    {
        return Normalizer::array($value);
    }
}
