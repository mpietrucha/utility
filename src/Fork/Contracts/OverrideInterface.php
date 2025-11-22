<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface OverrideInterface
{
    /**
     * Determine if the override matches the given namespace.
     */
    public function matches(string $namespace): bool;

    /**
     * Get the override file path.
     */
    public function file(): string;

    /**
     * Get the override class name.
     */
    public function class(): string;

    /**
     * Get the override namespace.
     */
    public function namespace(): string;
}
