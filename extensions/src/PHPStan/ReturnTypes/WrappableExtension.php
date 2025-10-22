<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StaticType;

/**
 * @internal
 */
class WrappableExtension implements DynamicStaticMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return static::class();
    }

    public function isStaticMethodSupported(MethodReflection $method): bool
    {
        return $method->getName() === static::method();
    }

    public function getTypeFromStaticMethodCall(MethodReflection $method, StaticCall $call, Scope $scope): ObjectType|StaticType
    {
        $class = $method->getDeclaringClass();

        return $this->type($class) ?? new StaticType($class);
    }

    protected function type(ClassReflection $class): ?ObjectType
    {
        $property = static::property();

        if ($class->hasNativeProperty($property) |> Normalizer::not(...)) {
            return null;
        }

        $property = $class->getNativeProperty($property)->getReadableType();

        if ($property->isClassString()->no()) {
            return null;
        }

        $property = $property->getReferencedClasses() |> Arr::first(...);

        if (Type::null($property)) {
            return null;
        }

        return new ObjectType($property);
    }

    /**
     * @return class-string
     */
    protected static function class(): string
    {
        return \Mpietrucha\Utility\Contracts\WrappableInterface::class;
    }

    protected static function method(): string
    {
        return 'wrap';
    }

    protected static function property(): string
    {
        return 'wrappable';
    }
}
