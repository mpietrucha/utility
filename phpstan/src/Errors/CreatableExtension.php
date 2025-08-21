<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Errors;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;
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
        $supported = $this->supported($scope);

        if ($supported && $this->interactsWithUnsafeNewStatic($error)) {
            return true;
        }

        return $this->interactsWithCreatable($error, $scope, $supported);
    }

    protected function interactsWithUnsafeNewStatic(Error $error): bool
    {
        return $error->getIdentifier() === 'new.static';
    }

    protected function interactsWithCreatable(Error $error, Scope $scope, bool $supported): bool
    {
        $message = $error->getMessage();

        if ($supported) {
            return Str::is('Method *::create() should return static(*) but returns static(*).', $message);
        }

        if ($this->implements($scope) === false) {
            return false;
        }

        if ($this->declares($error, '*::create(*)*') === false) {
            return false;
        }

        return Str::is('Method *::*() should return static(*) but returns static(*).', $message);
    }

    protected function supported(Scope $scope): bool
    {
        if ($scope->isInTrait() === false) {
            return false;
        }

        return $scope->getTraitReflection()->getName() === self::trait();
    }

    protected function implements(Scope $scope): bool
    {
        if ($scope->isInClass() === false) {
            return false;
        }

        $interface = self::interface();

        return $scope->getClassReflection()->implementsInterface($interface) === true;
    }

    protected function declares(Error $error, string $code): bool
    {
        $lines = $error->getFilePath() |> Filesystem::lines(...);

        $line = $error->getLine() - 1 |> $lines->get(...);

        if (Type::null($line)) {
            return false;
        }

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
