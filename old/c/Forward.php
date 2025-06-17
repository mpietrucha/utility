<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Forward\Evaluable;
use Mpietrucha\Utility\Forward\Proxy;
use Mpietrucha\Utility\Value\Contracts\AttemptInterface;

class Forward implements CreatableInterface, ForwardInterface
{
    use Creatable;

    protected ?EvaluableInterface $evaluable = null;

    public function __construct(protected object|string $destination, protected null|object|string $source = null, protected ?string $method = null)
    {
    }

    public function source(): object|string
    {
        return $this->source ??= $this->destination();
    }

    public function destination(): object|string
    {
        return $this->destination;
    }

    public function proxy(): ProxyInterface
    {
        return Proxy::create($this);
    }

    public function evaluable(): EvaluableInterface
    {
        return $this->evaluable ??= Evaluable::create($this->destination());
    }

    public function get(string $method, mixed ...$arguments): mixed
    {
        return $this->eval($method, $arguments);
    }

    public function eval(string $method, array $arguments): mixed
    {
        $attempt = Value::rescue($this->evaluable())->get($method, $arguments);

        $attempt->failed() && $this->fail($attempt, $method);

        return $attempt->response();
    }

    protected function fail(AttemptInterface $attempt, string $method): void
    {

    }
}
