<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Support\Error;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use PHPStan\Analyser\Error;

/**
 * @internal
 */
final class Line
{
    public static function for(Error $error): Stringable
    {
        $lines = $error->getFilePath() |> Filesystem::lines(...);

        $line = $error->getLine() - 1 |> $lines->get(...);

        return Str::of($line);
    }
}
