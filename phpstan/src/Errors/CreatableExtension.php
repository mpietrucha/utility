<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\Errors;

use Mpietrucha\PHPStan\Concerns\InteractsWithError;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class CreatableExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /**
     * Get the list of error identifiers this extension handles.
     *
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [
            'new.static',
        ];
    }

    /**
     * Determine if the given error should be ignored.
     */
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        $trait = $this->usesTrait($scope);

        if ($trait && $this->interactsWithIdentifiers($error)) {
            return true;
        }

        return $this->interactsWithCreatable($error, $scope, $trait);
    }

    /**
     * Check if the error relates to creatable pattern implementation.
     */
    protected function interactsWithCreatable(Error $error, Scope $scope, bool $trait): bool
    {
        if ($trait) {
            return $this->interactsWithMessage($error, 'Method *::create() should return static(*) but returns static(*).');
        }

        if ($this->implementsInterface($scope) === false) {
            return false;
        }

        if ($this->interactsWithFileContentLine($error, '*::create(*)*') === false) {
            return false;
        }

        return $this->interactsWithMessage($error, 'Method *::*() should return static(*) but returns static(*).');
    }

    /**
     * Check if the current scope uses the Creatable trait.
     */
    protected function usesTrait(Scope $scope): bool
    {
        if ($scope->isInTrait() === false) {
            return false;
        }

        return $scope->getTraitReflection()->getName() === \Mpietrucha\Utility\Concerns\Creatable::class;
    }

    /**
     * Check if the current scope implements the CreatableInterface.
     */
    protected function implementsInterface(Scope $scope): bool
    {
        if ($scope->isInClass() === false) {
            return false;
        }

        return \Mpietrucha\Utility\Contracts\CreatableInterface::class |> $scope->getClassReflection()->implementsInterface(...);
    }
}
