<?php

declare(strict_types=1);

namespace Mpietrucha\PHPStan\TypeSpecifiers;

use Mpietrucha\PHPStan\Concerns\InteractsWithTypeSpecifier;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Type;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Analyser\SpecifiedTypes;
use PHPStan\Analyser\TypeSpecifierAwareExtension;
use PHPStan\Analyser\TypeSpecifierContext;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\StaticMethodTypeSpecifyingExtension;

/**
 * @internal
 */
final class CompatibleExtension implements StaticMethodTypeSpecifyingExtension, TypeSpecifierAwareExtension
{
    use InteractsWithTypeSpecifier;

    public function getClass(): string
    {
        return \Mpietrucha\Utility\Contracts\CompatibleInterface::class;
    }

    public function isStaticMethodSupported(MethodReflection $method, StaticCall $node, TypeSpecifierContext $context): bool
    {
        $method = $method->getName();

        return Arr::contains(self::methods(), $method);
    }

    public function specifyTypes(MethodReflection $method, StaticCall $node, Scope $scope, TypeSpecifierContext $context): SpecifiedTypes
    {
        $assertions = $scope->getClassReflection() |> $this->assertions(...);

        $types = new SpecifiedTypes;

        $context = match (true) {
            $method->getName() === self::compatible() => $context,
            $context->null() => $context,
            default => $context->negate()
        };

        $arguments = $node->getArgs() |> Collection::create(...);

        while ($assertions->isNotEmpty()) {
            $argument = $arguments->shift();

            if (Type::null($argument)) {
                break;
            }

            $types = $this->specifier()->create(
                $argument->value,
                $assertions->shift()->getType(),
                $context,
                $scope
            ) |> $types->unionWith(...);
        }

        return $types;
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \PHPStan\PhpDoc\Tag\AssertTag>
     */
    protected function assertions(ClassReflection $reflection): EnumerableInterface
    {
        $assertions = Collection::create();

        $method = self::compatibility();

        if ($reflection->hasNativeMethod($method) === false) {
            return $assertions;
        }

        return $reflection->getNativeMethod($method)->getAsserts()->getAssertsIfTrue() |> $assertions->merge(...);
    }

    /**
     * @return list<string>
     */
    protected static function methods(): array
    {
        return [
            self::compatible(),
            self::incompatible(),
        ];
    }

    protected static function compatible(): string
    {
        return 'compatible';
    }

    protected static function incompatible(): string
    {
        return 'incompatible';
    }

    protected static function compatibility(): string
    {
        return 'compatibility';
    }
}
