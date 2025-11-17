<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface IdentifierInterface
{
    /**
     * Generate a unique identifier for the given finder.
     */
    public function identify(FinderInterface $finder): string;
}
