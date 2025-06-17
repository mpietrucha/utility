<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan;

use Mpietrucha\Utility\Data;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifier;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\CallableType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IterableType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\ObjectWithoutClassType;
use PHPStan\Type\ResourceType;
use PHPStan\Type\StaticMethodTypeSpecifyingExtension;
use PHPStan\Type\StringType;
use PHPStan\Type\UnionType;

/**
 * @internal
 */
final class TypeExtension implements StaticMethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    protected TypeSpecifier $type;

    public function setTypeSpecifier(TypeSpecifier $type): void
    {
        $this->type = $type;
    }

    public function getClass(): string
    {
        return \Mpietrucha\Utility\Type::class;
    }

    public function isStaticMethodSupported(MethodReflection $method, StaticCall $node, TypeSpecifierContext $context): bool
    {
        return in_array($method->getName(), [
            'null',
            'boolean',
            'integer',
            'flot',
            'numeric',
            'string',
            'array',
            'resource',
            'object',
            'scalar',
            'callable',
            'countable',
            'iterable',
        ]);
    }

    public function specifyTypes(MethodReflection $method, StaticCall $node, Scope $scope, TypeSpecifierContext $context): SpecifiedTypes
    {
        $method = $method->getName();

        $value = Data::get($node->getArgs(), '{first}.value');

        return $this->type->create($value, $this->$method(), $context, $scope);
    }

    protected function mixed(): MixedType
    {
        return new MixedType;
    }

    protected function null(): NullType
    {
        return new NullType;
    }

    protected function boolean(): BooleanType
    {
        return new BooleanType;
    }

    protected function integer(): IntegerType
    {
        return new IntegerType;
    }

    protected function float(): FloatType
    {
        return new FloatType;
    }

    protected function string(): StringType
    {
        return new StringType;
    }

    protected function array(): ArrayType
    {
        return new ArrayType($this->mixed(), $this->mixed());
    }

    protected function resource(): ResourceType
    {
        return new ResourceType;
    }

    protected function object(?string $class = null): ObjectType|ObjectWithoutClassType
    {
        return $class === null ? new ObjectWithoutClassType : new ObjectType($class);
    }

    protected function scalar(): UnionType
    {
        return $this->union([
            $this->integer(),
            $this->float(),
            $this->string(),
            $this->boolean(),
        ]);
    }

    protected function callable(): CallableType
    {
        return new CallableType;
    }

    protected function countable(): UnionType
    {
        return $this->union([
            $this->array(),
            $this->object(\Countable::class),
        ]);
    }

    protected function iterable(): IterableType
    {
        return new IterableType($this->mixed(), $this->mixed());
    }

    /**
     * @param  array<int, \PHPStan\Type\Type>  $types
     */
    protected function union(array $types): UnionType
    {
        return new UnionType($types);
    }
}
