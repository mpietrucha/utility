<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Stubs;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Filesystem\Path;
use PHPStan\PhpDoc\StubFilesExtension;

/**
 * @internal
 */
final class ExternalExtension implements StubFilesExtension
{
    /**
     * @var list<string>
     */
    protected static array $defaults = [
        'vendor/larastan/larastan/stubs/common/Support/Str.stub',
    ];

    /**
     * Get the list of external stub files for PHPStan analysis.
     *
     * @return array<array-key, string>
     */
    public function getFiles(): array
    {
        $defaults = self::defaults();

        return Arr::map($defaults, Path::get(...));
    }

    /**
     * Get the default list of stub file paths.
     *
     * @return array<array-key, string>
     */
    protected static function defaults(): array
    {
        return self::$defaults;
    }
}
