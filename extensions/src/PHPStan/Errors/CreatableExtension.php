<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class CreatableExtension implements IgnoreErrorExtension
{
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        $trait = $this->usesTrait($scope);

        if ($trait & $this->interactsWithUnsafeNewStatic($error)) {
            return true;
        }

        return $this->interactsWithCreatable($error, $scope, $trait);
    }

    protected function interactsWithUnsafeNewStatic(Error $error): bool
    {
        return $error->getIdentifier() === 'new.static';
    }

    protected function interactsWithCreatable(Error $error, Scope $scope, bool $trait): bool
    {
        $message = $error->getMessage();

        if ($trait) {
            return Str::is('Method *::create() should return static(*) but returns static(*).', $message);
        }

        if ($this->implementsInterface($scope) === false) {
            return false;
        }

        if ($this->interactsWithCode($error, '*::create(*)*') === false) {
            return false;
        }

        return Str::is('Method *::*() should return static(*) but returns static(*).', $message);
    }

    protected function usesTrait(Scope $scope): bool
    {
        if ($scope->isInTrait() === false) {
            return false;
        }

        return $scope->getTraitReflection()->getName() === self::trait();
    }

    protected function implementsInterface(Scope $scope): bool
    {
        if ($scope->isInClass() === false) {
            return false;
        }

        return self::interface() |> $scope->getClassReflection()->implementsInterface(...);
    }

    protected function interactsWithCode(Error $error, string $code): bool
    {
        $lines = $error->getFilePath() |> Filesystem::lines(...);

        $line = $error->getLine() - 1 |> $lines->get(...);

        return Str::is($code, $line);
    }

    protected static function trait(): string
    {
        return \Mpietrucha\Utility\Concerns\Creatable::class;
    }

    protected static function interface(): string
    {
        return \Mpietrucha\Utility\Contracts\CreatableInterface::class;
    }
}
