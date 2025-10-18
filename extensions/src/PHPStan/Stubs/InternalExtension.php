<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Stubs;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder;
use PHPStan\PhpDoc\StubFilesExtension;

/**
 * @internal
 */
final class InternalExtension implements StubFilesExtension
{
    /**
     * @return list<string>
     */
    public function getFiles(): array
    {
        $finder = Path::directory(__DIR__, 3) |> Finder::uncached()
            ->path('storage/stubs')
            ->files()
            ->in(...);

        return $finder->get()->keys()->toArray();
    }
}
