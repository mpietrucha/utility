<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\ReturnTypes;

use Mpietrucha\Utility\Reflection;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;

/**
 * @internal
 */
final class EnumExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return \Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface::class;
    }

    public function isMethodSupported(MethodReflection $method): bool
    {
        return $method->getName() === 'value';
    }

    public function getTypeFromMethodCall(MethodReflection $method, MethodCall $call, Scope $scope): Type
    {
        $reflection = $method->getDeclaringClass()->getName() |> Reflection::enum(...);

        if ($reflection->isNotBacked()) {
            return new IntegerType;
        }

        $type = $reflection->getBackingType()->getName();

        return match ($type) {
            'int' => new IntegerType,
            default => new StringType
        };
    }
}
