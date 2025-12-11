<?php

namespace Mpietrucha\Utility\Reflection;

use Closure;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionLambdaInterface;

class Lambda extends ReflectionClosure implements ReflectionLambdaInterface
{
    use Creatable;

    public function __construct(callable $lambda, ?string $code = null)
    {
        parent::__construct(Closure::fromCallable($lambda), $code);
    }
}
