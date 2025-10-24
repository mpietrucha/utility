<?php

namespace Mpietrucha\Extensions\PHPStan\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use PHPStan\Analyser\Error;

trait InteractsWithError
{
    /**
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [];
    }

    protected function interactsWithMessage(Error $error, string $value): bool
    {
        return Str::is($value, $error->getMessage());
    }

    /**
     * @param  list<string>  $identifiers
     */
    protected function interactsWithIdentifiers(Error $error, ?array $identifiers = null): bool
    {
        $identifiers ??= static::identifiers();

        return Arr::contains($identifiers, $error->getIdentifier());
    }

    protected function interactsWithIdentifier(Error $error, string $identifier): bool
    {
        $identifiers = Arr::overlap($identifier);

        return $this->interactsWithIdentifiers($error, $identifiers);
    }

    protected function interactsWithFileContent(Error $error, string $value): bool
    {
        $content = $this->getErrorFileContent($error);

        return Str::is($value, $content);
    }

    protected function interactsWithFileContentLine(Error $error, string $value): bool
    {
        $content = $this->getErrorFileLine($error) |> $this->getErrorFileContentLines($error)->get(...);

        return Str::is($value, $content);
    }

    protected function getErrorFileLine(Error $error): int
    {
        return $error->getLine() - 1;
    }

    protected function getErrorFilePath(Error $error): string
    {
        return $error->getTraitFilePath() ?? $error->getFilePath();
    }

    protected function getErrorFileContent(Error $error): string
    {
        return $this->getErrorFilePath($error) |> Filesystem::get(...);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected function getErrorFileContentLines(Error $error): EnumerableInterface
    {
        return $this->getErrorFilePath($error) |> Filesystem::lines(...);
    }
}
