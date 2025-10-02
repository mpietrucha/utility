<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\BuilderInterface;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Type;

class Builder implements BuilderInterface, CreatableInterface
{
    use Arrayable, Creatable;

    protected null|object|string $source = null;

    protected ?string $method = null;

    protected ?FailureInterface $failure = null;

    protected ?EvaluableInterface $evaluable = null;

    /**
     * Create a new forward builder for the given destination class or object.
     */
    public function __construct(protected object|string $destination)
    {
    }

    public static function destination(object|string $destination): static
    {
        return static::create($destination);
    }

    /**
     * Get the builder’s current configuration as an ordered array.
     */
    final public function toArray(): array
    {
        return [
            $this->destination,
            $this->source,
            $this->method,
            $this->failure,
            $this->evaluable,
        ];
    }

    /**
     * Specify a default method name to be invoked by the forward.
     */
    public function method(string $method): static
    {
        $this->method = $method;

        return $this;
    }

    public function relay(?string $method = null): static
    {
        return $this->source($this->toArray() |> Arr::first(...), $method);
    }

    /**
     * Specify the source class or object that the forward should appear to originate from.
     */
    public function source(object|string $source, ?string $method = null): static
    {
        Type::string($method) && $this->method($method);

        $this->source = $source;

        return $this;
    }

    /**
     * Attach a custom failure handler to the forward configuration.
     */
    public function failable(FailureInterface $failure): static
    {
        $this->failure = $failure;

        return $this;
    }

    /**
     * Attach a pre-built evaluable callback to the forward configuration.
     */
    public function evaluable(EvaluableInterface $evaluable): static
    {
        $this->evaluable = $evaluable;

        return $this;
    }

    /**
     * Build and return the fully configured Forward instance.
     */
    public function build(): ForwardInterface
    {
        return Forward::create(...) |> $this->toCollection()->pipeSpread(...);
    }
}
