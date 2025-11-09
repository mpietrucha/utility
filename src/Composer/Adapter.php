<?php

namespace Mpietrucha\Utility\Composer;

use Illuminate\Support\Composer;
use Mpietrucha\Utility\Composer\Contracts\AdapterInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @property-read string $workingPath
 */
class Adapter extends Composer implements AdapterInterface
{
    use Wrappable;

    /**
     * @var class-string
     */
    protected static string $wrappable = AdapterInterface::class;

    /**
     * Create a new Composer adapter instance for the given working directory.
     */
    public function __construct(string $cwd)
    {
        parent::__construct(Filesystem::adapter(), $cwd);
    }

    /**
     * Get the current working directory.
     */
    public function cwd(): string
    {
        return $this->workingPath;
    }

    /**
     * Find the Composer binary path.
     */
    public function binary(?string $name = null): array
    {
        return $this->findComposer($name);
    }

    /**
     * Get the path to the composer.json file.
     */
    public function file(): string
    {
        return $this->findComposerFile();
    }

    /**
     * Determine if the given package exists in the project.
     */
    public function exists(string $package): bool
    {
        return $this->hasPackage($package);
    }

    /**
     * Determine if the given package does not exist in the project.
     */
    final public function unexists(string $package): bool
    {
        return $this->exists($package) |> Normalizer::not(...);
    }

    /**
     * Modify the composer.json file using a callback.
     */
    public function configure(callable $callback): void
    {
        $this->modify($callback);
    }

    /**
     * Require packages using Composer.
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        $packages = static::normalize($packages);

        return $this->requirePackages($packages, $dev, $output, $binary);
    }

    /**
     * Remove packages using Composer.
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool
    {
        $packages = static::normalize($packages);

        return $this->removePackages($packages, $dev, $output, $binary);
    }

    /**
     * Dump the autoload files.
     */
    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        $extra = static::normalize($extra);

        return $this->dumpAutoloads($extra, $binary);
    }

    /**
     * Dump optimized autoload files.
     */
    public function optimize(?string $binary = null): int
    {
        return $this->dumpOptimized($binary);
    }

    /**
     * Normalize the given value to an array.
     *
     * @param  null|string|list<string>  $value
     * @return list<string>
     */
    protected static function normalize(null|array|string $value): array
    {
        return Normalizer::array($value);
    }
}
