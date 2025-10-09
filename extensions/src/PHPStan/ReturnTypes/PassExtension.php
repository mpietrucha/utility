<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;

/**
 * @internal
 */
final class PassExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return \Mpietrucha\Utility\Forward\Contracts\PassInterface::class;
    }

    public function isMethodSupported(MethodReflection $reflection): bool
    {
        return true;
    }

    public function getTypeFromMethodCall(MethodReflection $reflection, MethodCall $method, Scope $scope): Type
    {
        return new MixedType;
    }
}
