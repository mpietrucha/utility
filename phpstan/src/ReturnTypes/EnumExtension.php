<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\ReturnTypes;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
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
        $value = $call->var |> $scope->getType(...);

        $name = $value->getObjectClassNames() |> Arr::first(...);

        if ($name === $this->getClass()) {
            return new MixedType;
        }

        $reflection = Reflection::enum($name);

        if ($reflection->isBacked() |> Normalizer::not(...)) {
            return new StringType;
        }

        return match (true) { /** @phpstan-ignore-next-line method.nonObject */
            $reflection->getBackingType()->getName() === 'int' => new IntegerType,
            default => new StringType
        };
    }
}
