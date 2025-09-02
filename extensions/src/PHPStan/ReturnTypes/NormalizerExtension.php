<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Data;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
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
    public function getClass(): string
    {
        return \Mpietrucha\Utility\Normalizer::class;
    }

    public function isStaticMethodSupported(MethodReflection $method): bool
    {
        return $method->getName() === 'array';
    }

    public function getTypeFromStaticMethodCall(MethodReflection $method, StaticCall $call, Scope $scope): Type
    {
        $value = Data::get($call->getArgs(), '{first}.value');

        $argument = $scope->getType($value);

        return $this->union(...) |> $this->types($argument)->pipe(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \PHPStan\Type\Type>
     */
    protected function types(Type $argument): Collection
    {
        $types = TypeUtils::flattenTypes($argument);

        return $this->type(...) |> Collection::create($types)->map(...);
    }

    protected function type(Type $type): Type
    {
        $constans = $type->getConstantArrays();

        if (Arr::isNotEmpty($constans)) {
            return $this->union($constans);
        }

        if ($type->isNull()->yes()) {
            return $this->array();
        }

        if ($type->isArray()->yes()) {
            return $type;
        }

        if ($type->isIterable()->no()) {
            return $this->array(new IntegerType, $type);
        }

        return $this->array($type->getIterableKeyType(), $type->getIterableValueType());
    }

    /**
     * @param  iterable<int, \PHPStan\Type\Type>  $types
     */
    protected function union(iterable $types): Type
    {
        return TypeCombinator::union(...$types);
    }

    protected function array(?Type $key = null, ?Type $value = null): ArrayType
    {
        $key ??= new MixedType;

        $value ??= new MixedType;

        return new ArrayType($key, $value);
    }
}
