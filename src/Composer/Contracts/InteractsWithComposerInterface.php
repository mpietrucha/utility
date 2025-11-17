<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithComposerInterface
{
    /**
     * Get the composer instance.
     */
    public function composer(): ComposerInterface;
}
