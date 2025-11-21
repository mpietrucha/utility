<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;

/**
 * @mixin \Mpietrucha\Utility\Normalizer
 *
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Result implements CreatableInterface, ResultInterface
{
    use Creatable, Forwardable;

    protected ?InteractsWithThrowableInterface $throwable = null;

    /**
     * Create a new result instance from the given value and optional error.
     */
    public function __construct(protected mixed $value, protected ?Throwable $error)
    {
    }

    /**
     * Call a method on the result value.
     *
     * @param  MixedArray  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $forward = Normalizer::class |> $this->forward(...);

        $value = $this->value();

        return $forward->get($method, $value);
    }

    /**
     * Get the raw value returned by the evaluation.
     */
    public function value(): mixed
    {
        return $this->value;
    }

    /**
     * Get the original throwable captured during the evaluation, if any.
     */
    public function error(): ?Throwable
    {
        return $this->error;
    }

    /**
     * Get (or build) the wrapped throwable representation, or null on success.
     */
    public function throwable(): ?InteractsWithThrowableInterface
    {
        if ($this->succeeded()) {
            return null;
        }

        return $this->throwable ??= $this->error() |> Utility\Throwable::wrap(...);
    }

    /**
     * Determine whether the evaluation completed without throwing.
     */
    public function succeeded(): bool
    {
        return $this->error() |> Type::null(...);
    }

    /**
     * Determine whether the evaluation resulted in an exception.
     */
    final public function failed(): bool
    {
        return $this->succeeded() |> Normalizer::not(...);
    }

    /**
     * Check if the captured error matches the given throwable type.
     */
    public function caught(object|string $throwable): bool
    {
        if ($this->succeeded()) {
            return false;
        }

        return Instance::is($this->throwable()->value(), $throwable);
    }
}
