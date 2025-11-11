<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\ReturnTypes;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ErrorType;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;

/**
 * @internal
 */
final class TapExtension implements DynamicMethodReturnTypeExtension
{
    /**
     * Get the class name this extension supports.
     */
    public function getClass(): string
    {
        return \Mpietrucha\Utility\Forward\Contracts\TapInterface::class;
    }

    /**
     * Check if the given method is supported by this extension.
     */
    public function isMethodSupported(MethodReflection $method): bool
    {
        return true;
    }

    /**
     * Get the return type from the method call.
     */
    public function getTypeFromMethodCall(MethodReflection $method, MethodCall $call, Scope $scope): Type
    {
        $tap = $call->var |> $scope->getType(...);

        $type = $tap->getTemplateType($this->getClass(), 'T');

        return $type instanceof ErrorType ? new MixedType : $type;
    }
}
