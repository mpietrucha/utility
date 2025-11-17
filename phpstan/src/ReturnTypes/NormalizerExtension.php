<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\ReturnTypes;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Data;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Accessory\AccessoryArrayListType;
use PHPStan\Type\ArrayType;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\TypeUtils;

/**
 * @internal
 */
final class NormalizerExtension implements DynamicStaticMethodReturnTypeExtension
{
    /**
     * Get the class name this extension supports.
     */
    public function getClass(): string
    {
        return \Mpietrucha\Utility\Normalizer::class;
    }

    /**
     * Check if the given method is supported by this extension.
     */
    public function isStaticMethodSupported(MethodReflection $method): bool
    {
        return $method->getName() === 'array';
    }

    /**
     * Get the return type from the static method call.
     */
    public function getTypeFromStaticMethodCall(MethodReflection $method, StaticCall $call, Scope $scope): Type
    {
        $value = Data::get($call->getArgs(), '{first}.value');

        $argument = $scope->getType($value);

        return $this->union(...) |> $this->types($argument)->pipe(...);
    }

    /**
     * Convert the argument type into a collection of normalized types.
     *
     * @return \Mpietrucha\Utility\Collection<int, \PHPStan\Type\Type>
     */
    protected function types(Type $argument): Collection
    {
        $types = TypeUtils::flattenTypes($argument);

        return $this->type(...) |> Collection::create($types)->map(...);
    }

    /**
     * Normalize a single type into a list type.
     */
    protected function type(Type $type): Type
    {
        $constants = $type->getConstantArrays();

        if (Arr::isNotEmpty($constants)) {
            return $this->union($constants) |> $this->list(...);
        }

        if ($type->isNull()->yes()) {
            return $this->list();
        }

        if ($type->isArray()->yes() && $type->isList()->yes()) {
            return $type;
        }

        if ($type->isIterable()->no()) {
            return $this->list($type);
        }

        return $type->getIterableValueType() |> $this->list(...);
    }

    /**
     * Create a union type from multiple types.
     *
     * @param  iterable<int, \PHPStan\Type\Type>  $types
     */
    protected function union(iterable $types): Type
    {
        return TypeCombinator::union(...$types);
    }

    /**
     * Create a list array type with the given value type.
     */
    protected function list(?Type $value = null): Type
    {
        $value ??= new MixedType;

        $array = new ArrayType(new IntegerType, $value);

        return TypeCombinator::intersect($array, new AccessoryArrayListType);
    }
}
