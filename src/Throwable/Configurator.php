<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Throwable\Contracts\ConfiguratorInterface;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Configurator implements ConfiguratorInterface, CreatableInterface
{
    use Creatable;

    protected static ?string $default = null;

    /**
     * Create a new configurator for the given throwable instance.
     */
    public function __construct(protected ThrowableInterface $throwable, protected ?string $configurator = null)
    {
    }

    /**
     * Create a configurator for the given throwable with an optional configurator method name.
     */
    public static function for(ThrowableInterface $throwable, ?string $configurator = null): static
    {
        return static::create($throwable, $configurator);
    }

    /**
     * Set the default configurator method name to use.
     */
    public static function use(string $default): void
    {
        static::$default = $default;
    }

    /**
     * Get the default configurator method name.
     */
    public static function default(): string
    {
        return static::$default ??= 'configure';
    }

    /**
     * Get the throwable instance being configured.
     */
    public function throwable(): ThrowableInterface
    {
        return $this->throwable;
    }

    /**
     * Get the configurator method name to invoke.
     */
    public function configurator(): string
    {
        return $this->configurator ??= static::default();
    }

    /**
     * Create a forward instance for the throwable with optional method relay.
     */
    public function forward(?string $method = null): ForwardInterface
    {
        $builder = $this->throwable() |> Forward::builder(...);

        $builder->relay($method);

        return $builder->build();
    }

    /**
     * Evaluate the configurator method with arguments and return the configured throwable.
     */
    public function eval(array $arguments, ?string $method = null): ThrowableInterface
    {
        $response = $this->forward($method)->eval($this->configurator(), $arguments);

        return $this->hydrate($response, $arguments);
    }

    /**
     * Hydrate the throwable with the configurator response or original arguments.
     *
     * @param  MixedArray  $arguments
     */
    protected function hydrate(mixed $response, array $arguments): ThrowableInterface
    {
        if (Type::string($response)) {
            $response = Arr::prepend($arguments, $response);
        }

        /** @phpstan-ignore-next-line argument.templateType */
        if (Arr::first($response) |> Type::not()->string(...)) {
            return $this->throwable();
        }

        return $this->throwable()->message(...$response);
    }
}
