<?php

namespace Mpietrucha\Extensions\PHPStan\Concerns;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stringable;
use Mpietrucha\Utility\Type;
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
        return $this->getErrorMessage($error)->is($value);
    }

    /**
     * @param  list<string>  $identifiers
     */
    protected function interactsWithIdentifiers(Error $error, ?array $identifiers = null): bool
    {
        $identifiers ??= static::identifiers();

        return $this->getErrorIdentifier($error)->contains($identifiers);
    }

    protected function interactsWithIdentifier(Error $error, string $identifier): bool
    {
        return $this->getErrorIdentifier($error)->is($identifier);
    }

    protected function interactsWithFileContent(Error $error, string $value): bool
    {
        return $this->getErrorFileContent($error)->is($value);
    }

    protected function interactsWithFileContentLine(Error $error, string $value): bool
    {
        $line = $this->getErrorFileContentLine($error);

        return Type::not()->null($line) && $line->is($value);
    }

    protected function getErrorMessage(Error $error): Stringable
    {
        return $error->getMessage() |> Str::of(...);
    }

    protected function getErrorIdentifier(Error $error): Stringable
    {
        return $error->getIdentifier() |> Str::of(...);
    }

    protected function getErrorFileLine(Error $error): int
    {
        return $error->getLine() - 1;
    }

    protected function getErrorFilePath(Error $error): string
    {
        return $error->getTraitFilePath() ?? $error->getFilePath();
    }

    protected function getErrorFileContent(Error $error): Stringable
    {
        return $this->getErrorFilePath($error) |> Filesystem::get(...) |> Str::of(...);
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Stringable>
     */
    protected function getErrorFileContentLines(Error $error): EnumerableInterface
    {
        return $this->getErrorFileContent($error)->lines()->mapToStringables() /** @phpstan-ignore return.type */;
    }

    protected function getErrorFileContentLine(Error $error): ?Stringable
    {
        return $this->getErrorFileLine($error) |> $this->getErrorFileContentLines($error)->get(...);
    }
}
