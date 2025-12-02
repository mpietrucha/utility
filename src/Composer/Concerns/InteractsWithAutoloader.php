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
    /**
     * Dump the Composer autoloader with optional extra arguments.
     */
    public function dump(null|array|string $extra = null, ?string $binary = null): int
    {
        $destination = match (true) { /** @phpstan-ignore match.unhandled */
            $this instanceof InteractsWithAdapterInterface => $this->adapter(), /** @phpstan-ignore-next-line instanceof.alwaysFalse */
            $this instanceof InteractsWithComposerInterface => $this->composer()
        };

        return $destination->dump($extra, $binary);
    }

    /**
     * Optimize the Composer autoloader.
     */
    public function optimize(?string $binary = null): int
    {
        $destination = match (true) { /** @phpstan-ignore match.unhandled  */
            $this instanceof InteractsWithAdapterInterface => $this->adapter(), /** @phpstan-ignore-next-line instanceof.alwaysFalse */
            $this instanceof InteractsWithComposerInterface => $this->composer()
        };

        return $destination->optimize($binary);
    }
}
