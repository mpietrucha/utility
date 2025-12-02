<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface MapInterface
{
    /**
     * Load the map from the given working directory.
     */
    public static function load(string $cwd): static;

    /**
     * Determine if the given namespace exists.
     */
    public function exists(string $namespace): bool;

    /**
     * Determine if the given namespace does not exist.
     */
    public function unexists(string $namespace): bool;

    /**
     * Get the file path for the given namespace.
     */
    public function file(string $namespace): ?string;

    /**
     * Get the namespace for the given file.
     */
    public function namespace(string $file): ?string;
}
