<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAutoloaderInterface
{
    /**
     * Dump the autoloader.
     *
     * @param  null|string|list<string>  $extra
     */
    public function dump(null|array|string $extra = null, ?string $binary = null): int;

    /**
     * Optimize the autoloader.
     */
    public function optimize(?string $binary = null): int;
}
