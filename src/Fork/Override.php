<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Fork\Contracts\OverrideInterface;
use Mpietrucha\Utility\Fork\Override\Normalizer;
use Mpietrucha\Utility\Fork\Override\Prefix;
use Mpietrucha\Utility\Type;

class Override implements CreatableInterface, OverrideInterface, WrappableInterface
{
    use Creatable, Wrappable;

    /**
     * @var class-string
     */
    protected static string $wrappable = OverrideInterface::class;

    /**
     * Create a new override instance.
     */
    public function __construct(protected string $file, protected ?string $namespace = null, protected ?string $class = null)
    {
    }

    /**
     * Create an override instance from the given namespace at runtime.
     */
    public static function runtime(string $namespace): ?OverrideInterface
    {
        $class = Prefix::skip($namespace);

        if (Type::null($class)) {
            return null;
        }

        return static::create(Normalizer::file($class), $namespace, $class);
    }

    /**
     * Determine if the override matches the given namespace.
     */
    public function matches(string $namespace): bool
    {
        return $namespace === $this->namespace();
    }

    /**
     * Set the override namespace with the given prefix.
     */
    public function prefix(string $prefix): static
    {
        $this->namespace = Prefix::build($this->class(), $prefix);

        return $this;
    }

    /**
     * Get the override file path.
     */
    public function file(): string
    {
        return $this->file;
    }

    /**
     * Get the override class name.
     */
    public function class(): string
    {
        return $this->class ??= $this->file() |> Normalizer::namespace(...);
    }

    /**
     * Get the override namespace.
     */
    public function namespace(): string
    {
        return $this->namespace ??= $this->class() |> Prefix::build(...);
    }
}
