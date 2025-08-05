<?php

namespace Mpietrucha\Utility\Forward\Proxy;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\RuntimeException;
use Mpietrucha\Utility\Type;

class Methods implements CreatableInterface, MethodsInterface
{
    use Creatable;

    /**
     * Create a new Methods instance.
     *
     * @param  \Mpietrucha\Utility\Collection<int, string>  $allowed
     * @param  \Mpietrucha\Utility\Collection<int, string>  $denied
     */
    public function __construct(protected Collection $allowed = new Collection, protected Collection $denied = new Collection)
    {
    }

    /**
     * Get the collection of explicitly allowed methods.
     *
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function allowed(): Collection
    {
        return $this->allowed;
    }

    /**
     * Get the collection of explicitly denied methods.
     *
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public function denied(): Collection
    {
        return $this->denied;
    }

    /**
     * Add the given method names to the denied list.
     */
    public function deny(array|string $methods): self
    {
        $this->denied()->push(...Normalizer::array($methods));

        return $this;
    }

    /**
     * Add the given method names to the allowed list.
     */
    public function allow(array|string $methods): self
    {
        $this->allowed()->push(...Normalizer::array($methods));

        return $this;
    }

    /**
     * Validate that the given method is permitted in the context of the instance.
     */
    public function validate(string $method, object|string $instance): void
    {
        $this->invalid($method) && $this->fail($method, $instance);
    }

    /**
     * Determine if the given method is invalid.
     */
    public function valid(string $method): bool
    {
        if ($this->denied()->contains($method)) {
            return true;
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

    /**
     * Throw an exception for an invalid method.
     */
    protected function fail(string $method, object|string $instance): void
    {
        $instance = Instance::namespace($instance);

        if (Type::null($instance)) {
            return;
        }

        RuntimeException::create()
            ->configure(4)
            ->message('Method `%s` is not allowed in context of %s::class', $method, $instance)
            ->throw();
    }
}
