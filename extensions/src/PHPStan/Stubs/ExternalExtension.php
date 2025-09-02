<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Stubs;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Filesystem\Path;
use PHPStan\PhpDoc\StubFilesExtension;

/**
 * @internal
 */
class ExternalExtension implements StubFilesExtension
{
    /**
     * @var array<int, string>
     */
    protected static array $defaults = [
        'vendor/larastan/larastan/stubs/common/Support/Str.stub',
    ];

    /**
     * @return array<int, string>
     */
    public function getFiles(): array
    {
        $defaults = static::defaults();

        return Arr::map($defaults, Path::current(...));
    }

    /**
     * @return array<int, string>
     */
    protected static function defaults(): array
    {
        return static::$defaults;
    }
}
