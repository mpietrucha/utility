<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Exception\Transformer;
use Mpietrucha\Utility\Forward\Attempt;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\InvokableInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Throwable;

class Forward implements CreatableInterface, ForwardInterface
{
    use Creatable, Evaluable;

    protected ?InvokableInterface $attempt = null;

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

    public function attempt(): InvokableInterface
    {
        return $this->attempt ??= Attempt::create($this->destination());
    }

    public function get(string $method, mixed ...$arguments): mixed
    {
        [$response, $throwable] = Rescue::get($this->attempt(), $method, ...$arguments);

        $throwable && $this->fail($throwable, $method);

        return $response;
    }

    protected function fail(Throwable $throwable, string $method): void
    {
        $backtrace = Backtrace::throwable($throwable);

        $transformer = Transformer::create($throwable);
    }
}
