<?php

namespace Mpietrucha\Extensions\PHPStan\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use PHPStan\Analyser\Error;

trait InteractsWithError
{
    /**
     * @return list<string>
     */
    protected function identifiers(): array
    {
        return [];
    }

    protected function interactsWithMessage(Error $error, string $message): bool
    {
        return Str::is($message, $error->getMessage());
    }

    /**
     * @param  array<array-key, string>|null  $identifiers
     */
    protected function interactsWithIdentifiers(Error $error, ?array $identifiers = null): bool
    {
        $identifiers ??= $this->identifiers();

        return Arr::contains($identifiers, $error->getIdentifier());
    }

    protected function interactsWithIdentifier(Error $error, string $identifier): bool
    {
        $identifiers = Arr::wrap($identifier);

        return $this->interactsWithIdentifiers($error, $identifiers);
    }

    protected function interactsWithCode(Error $error, string $code): bool
    {
        $content = static::file($error) |> Filesystem::get(...);

        return Str::is($code, $content);
    }

    protected function interactsWithLine(Error $error, string $line): bool
    {
        $lines = static::file($error) |> Filesystem::lines(...);

        $content = $error->getLine() - 1 |> $lines->get(...);

        return Str::is($line, $content);
    }

    protected static function file(Error $error): string
    {
        return $error->getTraitFilePath() ?? $error->getFilePath();
    }
}
