<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Str;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

/**
 * @internal
 */
final class MethodExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /**
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return [
            'method.notFound',
            'staticMethod.notFound',
        ];
    }

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifiers($error) === false) {
            return false;
        }

        return $this->interactsWithFileContent($error, $this->content($error));
    }

    protected function content(Error $error): string
    {
        $method = $this->method($error);

        return Str::sprintf('*Method::*exists(*, *%s*)*', $method);
    }

    protected function method(Error $error): string
    {
        return Str::between($error->getMessage(), '::', '().');
    }
}
