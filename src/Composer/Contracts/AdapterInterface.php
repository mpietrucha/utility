<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Contracts\WrappableInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface AdapterInterface extends InteractsWithAutoloaderInterface, WrappableInterface
{
    public function cwd(): string;

    /**
     * @return array<array-key, string>
     */
    public function binary(?string $name = null): array;

    public function file(): string;

    public function exists(string $package): bool;

    public function unexists(string $package): bool;

    public function configure(callable $callback): void;

    /**
     * @param  string|list<string>  $packages
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;

    /**
     * @param  string|list<string>  $packages
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;
}
