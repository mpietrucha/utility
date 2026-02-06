<?php

namespace Mpietrucha\PHPStan\TypeSpecifiers;

use Mpietrucha\PHPStan\Concerns\InteractsWithTypeSpecifier;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\MixedType;
use PHPStan\Type\Php\ConstantHelper;
use PHPStan\Type\StaticMethodTypeSpecifyingExtension;

/**
 * @internal
 */
final class ConstantExtension implements StaticMethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    use InteractsWithTypeSpecifier;

    public function __construct(protected ConstantHelper $constant)
    {
    }

    public function getClass(): string
    {
        return \Mpietrucha\Utility\Constant::class;
    }

    public function isStaticMethodSupported(MethodReflection $reflection, StaticCall $node, TypeSpecifierContext $context): bool
    {
        return true;
    }

    public function specifyTypes(MethodReflection $method, StaticCall $node, Scope $scope, TypeSpecifierContext $context): SpecifiedTypes
    {
        $value = $this->value($node, $scope);

        if (Type::null($value)) {
            return $this->unspecified();
        }

        /** @phpstan-ignore phpstanApi.method */
        $expression = $this->constant()->createExprFromConstantName($value);

        if (Type::null($expression)) {
            return $this->unspecified();
        }

        return $this->specifier()->create($expression, new MixedType, $context, $scope);
    }

    protected function value(StaticCall $node, Scope $scope): ?string
    {
        $argument = Data::get($node, 'args.{first}.value');

        if (Type::null($argument)) {
            return null;
        }

        $constant = $scope->getType($argument)->getConstantStrings() |> Arr::first(...);

        if (Type::null($constant)) {
            return null;
        }

        return $constant->getValue() |> Str::nullWhenEmpty(...);
    }

    protected function constant(): ConstantHelper
    {
        return $this->constant;
    }
}
