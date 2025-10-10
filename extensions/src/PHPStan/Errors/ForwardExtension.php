<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Utility\Str;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class ForwardExtension implements IgnoreErrorExtension
{
    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        return $this->interactsWithIdentifier($error) && $this->interactsWithMessage($error);
    }

    protected function interactsWithIdentifier(Error $error): bool
    {
        return $error->getIdentifier() === 'method.notFound';
    }

    protected function interactsWithMessage(Error $error): bool
    {
        $message = $error->getMessage();

        return Str::is('*Mpietrucha\Utility\Forward\Contracts\ProxyInterface::*(*).', $message);
    }
}
