<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAutoloadInterface
{
    /**
     * @param  null|string|list<string>  $extra
     */
    public function dump(null|array|string $extra = null, ?string $binary = null): int;

    public function optimize(?string $binary = null): int;
}
