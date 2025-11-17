<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Stubs;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder;
use PHPStan\PhpDoc\StubFilesExtension;

/**
 * @internal
 */
final class InternalExtension implements StubFilesExtension
{
    /**
     * Get the list of internal stub files for PHPStan analysis.
     *
     * @return list<string>
     */
    public function getFiles(): array
    {
        $finder = Path::directory(__DIR__, 2) |> Finder::uncached()
            ->path('stubs')
            ->files()
            ->in(...);

        return $finder->get()->keys()->toArray();
    }
}
