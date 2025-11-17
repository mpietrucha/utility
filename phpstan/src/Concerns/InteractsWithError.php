<?php

namespace Mpietrucha\PHPStan\Concerns;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use Mpietrucha\Utility\Type;
use PHPStan\Analyser\Error;

trait InteractsWithError
{
    /**
     * Get the list of error identifiers this extension handles.
     *
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [];
    }

    /**
     * Check if the error message matches the given pattern.
     */
    protected function interactsWithMessage(Error $error, string $value): bool
    {
        return $this->getErrorMessage($error)->is($value);
    }

    /**
     * Check if the error identifier matches any of the given identifiers.
     *
     * @param  list<string>  $identifiers
     */
    protected function interactsWithIdentifiers(Error $error, ?array $identifiers = null): bool
    {
        $identifiers ??= static::identifiers();

        return $this->getErrorIdentifier($error)->contains($identifiers);
    }

    /**
     * Check if the error identifier matches the given identifier.
     */
    protected function interactsWithIdentifier(Error $error, string $identifier): bool
    {
        return $this->getErrorIdentifier($error)->is($identifier);
    }

    /**
     * Check if the error file content matches the given pattern.
     */
    protected function interactsWithFileContent(Error $error, string $value): bool
    {
        return $this->getErrorFileContent($error)->is($value);
    }

    /**
     * Check if the error file content line matches the given pattern.
     */
    protected function interactsWithFileContentLine(Error $error, string $value): bool
    {
        $line = $this->getErrorFileContentLine($error);

        return Type::not()->null($line) && $line->is($value);
    }

    /**
     * Get the error message as a stringable instance.
     */
    protected function getErrorMessage(Error $error): Stringable
    {
        return $error->getMessage() |> Str::of(...);
    }

    /**
     * Get the error identifier as a stringable instance.
     */
    protected function getErrorIdentifier(Error $error): Stringable
    {
        return $error->getIdentifier() |> Str::of(...);
    }

    /**
     * Get the zero-based line number where the error occurred.
     */
    protected function getErrorFileLine(Error $error): int
    {
        return $error->getLine() - 1;
    }

    /**
     * Get the file path where the error occurred.
     */
    protected function getErrorFilePath(Error $error): string
    {
        return $error->getTraitFilePath() ?? $error->getFilePath();
    }

    /**
     * Get the entire error file content as a stringable instance.
     */
    protected function getErrorFileContent(Error $error): Stringable
    {
        return $this->getErrorFilePath($error) |> Filesystem::get(...) |> Str::of(...);
    }

    /**
     * Get all lines from the error file as a collection.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Stringable>
     */
    protected function getErrorFileContentLines(Error $error): EnumerableInterface
    {
        return $this->getErrorFileContent($error)->lines()->mapToStringables() /** @phpstan-ignore return.type */;
    }

    /**
     * Get the specific line where the error occurred.
     */
    protected function getErrorFileContentLine(Error $error): ?Stringable
    {
        return $this->getErrorFileLine($error) |> $this->getErrorFileContentLines($error)->get(...);
    }
}
