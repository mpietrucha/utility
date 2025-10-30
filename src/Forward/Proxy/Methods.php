<?php

namespace Mpietrucha\Utility\Forward\Proxy;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Exception\ProxyMethodException;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;

class Methods implements CreatableInterface, MethodsInterface
{
    use Creatable;

    /**
     * Create a new Methods instance.
     *
     * @param  \Mpietrucha\Utility\Collection<int, string>|null  $allowed
     * @param  \Mpietrucha\Utility\Collection<int, string>|null  $denied
     */
    public function __construct(protected ?Collection $allowed = null, protected ?Collection $denied = null)
    {
    }

    /**
     * Get the collection of explicitly allowed methods.
     *
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function allowed(): Collection
    {
        return $this->allowed ??= Collection::create();
    }

    /**
     * Get the collection of explicitly denied methods.
     *
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function denied(): Collection
    {
        return $this->denied ??= Collection::create();
    }

    /**
     * Add the given method names to the denied list.
     */
    public function deny(array|string $methods): static
    {
        $this->denied()->push(...) |> Collection::create($methods)->pipeSpread(...);

        return $this;
    }

    /**
     * Add the given method names to the allowed list.
     */
    public function allow(array|string $methods): static
    {
        $this->allowed()->push(...) |> Collection::create($methods)->pipeSpread(...);

        return $this;
    }

    /**
     * Validate that the given method is permitted in the context of the instance.
     */
    public function validate(string $method, object|string $instance): void
    {
        if ($this->valid($method)) {
            return;
        }

        ProxyMethodException::for($instance, $method)->throw();
    }

    /**
     * Determine if the given method is invalid.
     */
    public function valid(string $method): bool
    {
        if ($this->denied()->contains($method)) {
            return false;
        }

        return $this->allowed()->isEmpty() || $this->allowed()->contains($method);
    }

    /**
     * Determine if the given method is invalid.
     */
    public function invalid(string $method): bool
    {
        return $this->valid($method) |> Normalizer::not(...);
    }
}
