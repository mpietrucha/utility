<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAdapterInterface
{
    /**
     * Get the composer adapter instance.
     */
    public function adapter(): AdapterInterface;
}
