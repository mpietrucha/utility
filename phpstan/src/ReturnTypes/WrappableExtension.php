<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\ReturnTypes;

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
    /**
     * Get the class name this extension supports.
     */
    public function getClass(): string
    {
        return static::class();
    }

    /**
     * Check if the given static method is supported by this extension.
     */
    public function isStaticMethodSupported(MethodReflection $method): bool
    {
        return $method->getName() === static::method();
    }

    /**
     * Get the return type from the static method call.
     */
    public function getTypeFromStaticMethodCall(MethodReflection $method, StaticCall $call, Scope $scope): ObjectType|StaticType
    {
        $class = $method->getDeclaringClass();

        return $this->type($class) ?? new StaticType($class);
    }

    /**
     * Resolve the wrapped object type from the class property.
     */
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
     * Get the class name this extension supports.
     *
     * @return class-string
     */
    protected static function class(): string
    {
        return \Mpietrucha\Utility\Contracts\WrappableInterface::class;
    }

    /**
     * Get the method name to analyze.
     */
    protected static function method(): string
    {
        return 'wrap';
    }

    /**
     * Get the property name containing the wrapped class.
     */
    protected static function property(): string
    {
        return 'wrappable';
    }
}
