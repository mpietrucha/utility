<?php

namespace Mpietrucha\Extensions\PHPStan\Errors;

use Mpietrucha\Extensions\PHPStan\Concerns\InteractsWithError;
use Mpietrucha\Utility\Data;
use Mpietrucha\Utility\Instance\Path;
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
        if ($this->interactsWithIdentifier($error, 'return.type')) {
            return $this->interactsWithValue($error);
        }

        return $this->interactsWithIdentifiers($error) && $this->interactsWithInstance($error, $node);
    }

    protected function interactsWithInstance(Error $error, Node $node): bool
    {
        $instance = Data::get($node, 'var.name');

        if (Type::null($instance)) {
            return false;
        }

        $content = $this->pattern("$$instance", '*');

        return $this->interactsWithFileContent($error, $content);
    }

    protected function interactsWithValue(Error $error): bool
    {
        $value = $this->getErrorMessage($error)
            ->between('should return', 'but')
            ->before('|')
            ->before('<')
            ->trim() |> Path::name(...);

        $content = $this->pattern('*', "$value::class");

        return $this->interactsWithFileContent($error, $content);
    }

    protected function pattern(string $instance, string $value): string
    {
        return Str::sprintf('*Instance::*(%s, %s)*', $instance, $value);
    }
}
