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
final class PropertyExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /**
     * @return list<string>
     */
    public function identifiers(): array
    {
        return [
            'property.notFound',
            'staticProperty.notFound',
        ];
    }

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifiers($error) === false) {
            return false;
        }

        $code = Str::sprintf('*Property::*exists(*, *%s*)*', $this->property($error));

        return $this->interactsWithCode($error, $code);
    }

    protected function property(Error $error): string
    {
        return Str::between($error->getMessage(), '::$', '.');
    }
}
