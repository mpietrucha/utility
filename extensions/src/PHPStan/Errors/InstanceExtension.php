<?php

declare(strict_types=1);

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;
use PhpParser\Node;
use PHPStan\Analyser\Error;
use PHPStan\Analyser\IgnoreErrorExtension;
use PHPStan\Analyser\Scope;

class InstanceExtension implements IgnoreErrorExtension
{
    use InteractsWithError;

    /**
     * @return list<string>
     */
    public static function identifiers(): array
    {
        return MethodExtension::identifiers();
    }

    public function shouldIgnore(Error $error, Node $node, Scope $scope): bool
    {
        if ($this->interactsWithIdentifiers($error) === false) {
            return false;
        }

        $variable = Data::get($node, 'var.name');

        if (Type::null($variable)) {
            return false;
        }

        if ($this->interactsWithInstance($error, $variable, 'is')) {
            return true;
        }

        return $this->interactsWithInstance($error, $variable, 'not');
    }

    protected function interactsWithInstance(Error $error, string $variable, string $method): bool
    {
        $content = Str::sprintf('*Instance::%s($%s, *)*', $method, $variable);

        return $this->interactsWithFileContent($error, $content);
    }
}
