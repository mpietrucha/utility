<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\TypeSpecifiers;

use Mpietrucha\PHPStan\Concerns\InteractsWithTypeSpecifier;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Data;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\PhpDoc\Tag\AssertTag;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\StaticMethodTypeSpecifyingExtension;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

/**
 * @internal
 */
final class CompatibleExtension implements StaticMethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    use InteractsWithTypeSpecifier;

    public static function compatible(): string
    {
        return 'compatible';
    }

    public static function incompatible(): string
    {
        return 'incompatible';
    }

    public static function compatibility(): string
    {
        return 'compatibility';
    }

    /**
     * @return list<string>
     */
    public static function methods(): array
    {
        return [
            self::compatible(),
            self::incompatible(),
        ];
    }

    public function getClass(): string
    {
        return \Mpietrucha\Utility\Contracts\CompatibleInterface::class;
    }

    public function isStaticMethodSupported(MethodReflection $method, StaticCall $node, TypeSpecifierContext $context): bool
    {
        $methods = self::methods();

        return Arr::contains($methods, $method->getName());
    }

    public function specifyTypes(MethodReflection $method, StaticCall $node, Scope $scope, TypeSpecifierContext $context): SpecifiedTypes
    {
        $assertions = $scope->getClassReflection() |> $this->assertions(...) |> Collection::create(...);

        $types = $this->unspecified();

        $context = $this->context($method, $context);

        $arguments = $node->getArgs() |> Collection::create(...);

        while ($assertions->isNotEmpty() && $arguments->isNotEmpty()) {
            $value = Data::get($arguments->shift(), 'value');

            $types = $this->specifier()->create(
                $value,
                $this->type($assertions->shift(), $value, $scope),
                $context,
                $scope
            ) |> $types->unionWith(...);
        }

        return $types;
    }

    /**
     * @return array<int, \PHPStan\PhpDoc\Tag\AssertTag>
     */
    protected function assertions(ClassReflection $reflection): array
    {
        $method = self::compatibility();

        if ($reflection->hasNativeMethod($method) === false) {
            return [];
        }

        return $reflection->getNativeMethod($method)->getAsserts()->getAssertsIfTrue();
    }

    protected function context(MethodReflection $method, TypeSpecifierContext $context): TypeSpecifierContext
    {
        if ($method->getName() === self::compatible()) {
            return $context;
        }

        if ($context->null()) {
            return $context;
        }

        return $context->negate();
    }

    protected function type(AssertTag $assertion, Expr $value, Scope $scope): Type
    {
        $type = $assertion->getType();

        if ($assertion->isNegated() === false) {
            return $type;
        }

        return TypeCombinator::remove($scope->getType($value), $type);
    }
}
