<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface LoaderInterface
{
    public static function load(string $cwd): static;

    public function exists(string $namespace): bool;

    public function unexists(string $namespace): bool;

    public function file(string $namespace): ?string;

    public function namespace(string $file): ?string;
}
