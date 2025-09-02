<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Stubs;

use Mpietrucha\Utility\Finder;
use PHPStan\PhpDoc\StubFilesExtension;

/**
 * @internal
 */
final class InternalExtension implements StubFilesExtension
{
    /**
     * @return array<int,string>
     */
    public function getFiles(): array
    {
        return Finder::create('extensions/stubs')
            ->files()
            ->get()
            ->keys()
            ->toArray();
    }
}
