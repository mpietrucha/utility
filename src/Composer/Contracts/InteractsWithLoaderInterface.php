<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithLoaderInterface
{
    /**
     * Get the loader instance.
     */
    public function loader(): LoaderInterface;
}
