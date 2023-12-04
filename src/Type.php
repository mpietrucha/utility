<?php

namespace Mpietrucha\Support;

use Closure;
use Mpietrucha\Support\Concerns\Factoryable;

use function Mpietrucha\Support\Disclosure\disclosure;
use function Mpietrucha\Support\Disclosure\not;
use function Mpietrucha\Support\Disclosure\value;

class Type
{
    use Factoryable;

    protected bool|Closure $is = true;

    public function __construct(protected mixed $argument)
    {
    }

    public function __call(string $method, array $arguments): bool
    {
        return $this->handler($method)($this->argument) === value($this->is) && $this->is();
    }

    public function is(mixed $is = true): self
    {
        disclosure($this)->boolean()->is = $is;

        return $this;
    }

    public function not(mixed $not = true): self
    {
        disclosure($this)->boolean()->is = not($not);

        return $this;
    }

    protected function handler(string $method): Closure
    {
        return str("is_$method")->snake()->toString()(...);
    }
}
