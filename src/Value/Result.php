<?php

namespace Mpietrucha\Utility\Value;

use Mpietrucha\Utility;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;
use Throwable;

/**
 * @mixin \Mpietrucha\Utility\Normalizer
 */
class Result implements CreatableInterface, ResultInterface
{
    use Creatable, Forwardable;

    protected ?ThrowableInterface $throwable = null;

    protected static ?ThrowableInterface $previous = null;

    /**
     * Create a new result instance from the given value and optional failure.
     */
    public function __construct(protected mixed $value, protected ?Throwable $failure)
    {
        $this->throwable = static::utilize($failure);
    }

    /**
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->forward(Normalizer::class)->get($method, $this->value());
    }

    /**
     * Store the last processed throwable for later association.
     */
    public static function previous(ThrowableInterface $previous): void
    {
        static::$previous = $previous;
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
    public function failure(): ?Throwable
    {
        return $this->failure;
    }

    /**
     * Get (or build) the wrapped throwable representation, or null on success.
     */
    public function throwable(): ?ThrowableInterface
    {
        if ($this->succeeded()) {
            return null;
        }

        return $this->throwable ??= $this->failure() |> Utility\Throwable::create(...);
    }

    /**
     * Determine whether the evaluation completed without throwing.
     */
    public function succeeded(): bool
    {
        return $this->failure() |> Type::null(...);
    }

    /**
     * Determine whether the evaluation resulted in an exception.
     */
    final public function failed(): bool
    {
        return $this->succeeded() |> Normalizer::not(...);
    }

    /**
     * Check if the captured failure matches the given throwable type.
     */
    public function caught(object|string $throwable): bool
    {
        if ($this->succeeded()) {
            return false;
        }

        return Instance::is($this->failure(), $throwable) || Instance::is($this->throwable(), $throwable);
    }

    /**
     * Associate the previously processed throwable with the current failure when identical.
     */
    protected static function utilize(?Throwable $failure): ?ThrowableInterface
    {
        $previous = static::$previous;

        static::$previous = null;

        return $previous?->value() === $failure ? $previous : null;
    }
}
