<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Symfony\Component\Console\Output\OutputInterface;

interface ComposerInterface extends InteractsWithAutoloadInterface
{
    public static function autoload(): AutoloadInterface;

    public static function default(): ComposerInterface;

    public static function get(): ComposerInterface;

    /**
     * @return array<int, string>
     */
    public function binary(?string $name = null): array;

    public function file(): string;

    public function exists(string $package): bool;

    public function unexists(string $package): bool;

    public function configure(callable $callback): void;

    /**
     * @param  string|array<int, string>  $packages
     */
    public function require(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;

    /**
     * @param  string|array<int, string>  $packages
     */
    public function remove(array|string $packages, bool $dev = false, ?OutputInterface $output = null, ?string $binary = null): bool;
}
