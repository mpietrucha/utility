<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAutoloadInterface
{
    /**
     * Get the autoload instance.
     */
    public function autoload(): AutoloadInterface;
}
