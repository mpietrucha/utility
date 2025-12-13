<?php

namespace Mpietrucha\Utility\Reflection;

use Closure;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Reflection\Contracts\LambdaInterface;

class Lambda extends ReflectionClosure implements LambdaInterface
{
    use Creatable;

    public function __construct(callable $lambda, ?string $code = null)
    {
        $closure = static::closure($lambda);

        parent::__construct($closure, $code);
    }

    public static function closure(callable $lambda): Closure
    {
        return Closure::fromCallable($lambda);
    }
}
