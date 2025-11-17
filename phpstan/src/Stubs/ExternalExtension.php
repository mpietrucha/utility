<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Stubs;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
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
     * @return array<int, string>
     */
    public function getFiles(): array
    {
        $files = Path::get(...) |> self::defaults()->map(...);

        return $files->all();
    }

    /**
     * Get the default list of stub file paths.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function defaults(): EnumerableInterface
    {
        return self::$defaults |> Collection::create(...);
    }
}
