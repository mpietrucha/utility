<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan;

use Mpietrucha\Utility\Filesystem\File;
use Mpietrucha\Utility\Illuminate\Str;
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

        if ($this->declares($scope, '*::create(*)') === false) {
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
        $interface = self::interface();

        return $scope->getClassReflection()->implementsInterface($interface);
    }

    protected function declares(Error $error, string $code): bool
    {
        $file = $error->getFile();

        $line = $error->getLine();

        return File::lines($file)->get($line)->is($code);
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
