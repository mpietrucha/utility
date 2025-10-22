<?php

namespace Mpietrucha\Utility\Composer\Concerns;

use Mpietrucha\Utility\Composer\Contracts\InteractsWithAdapterInterface;
use Mpietrucha\Utility\Composer\Contracts\InteractsWithComposerInterface;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithAutoloaderInterface
 * @phpstan-require-implements \Mpietrucha\Utility\Composer\Contracts\InteractsWithComposerInterface|\Mpietrucha\Utility\Composer\Contracts\InteractsWithAdapterInterface
 */
trait InteractsWithAutoloader
{
    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        /**
         * @phpstan-ignore-next-line match.unhandled
         */
        $destination = match (true) {
            $this instanceof InteractsWithAdapterInterface => $this->adapter(), /** @phpstan-ignore-next-line instanceof.alwaysFalse */
            $this instanceof InteractsWithComposerInterface => $this->composer()
        };

        return $destination->dump($extra, $binary);
    }

    public function optimize(?string $binary = null): int
    {
        /**
         * @phpstan-ignore-next-line match.unhandled
         */
        $destination = match (true) {
            $this instanceof InteractsWithAdapterInterface => $this->adapter(), /** @phpstan-ignore-next-line instanceof.alwaysFalse */
            $this instanceof InteractsWithComposerInterface => $this->composer()
        };

        return $destination->optimize($binary);
    }
}
