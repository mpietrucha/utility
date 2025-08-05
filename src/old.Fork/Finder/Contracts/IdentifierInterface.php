<?php

namespace Mpietrucha\Utility\Finder\Contracts;

interface IdentifierInterface
{
    public function identify(FinderInterface $finder): string;
}
