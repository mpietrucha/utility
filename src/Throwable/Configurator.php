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

class Configurator implements ConfiguratorInterface, CreatableInterface
{
    use Creatable;

    protected static ?string $default = null;

    public function __construct(protected ThrowableInterface $throwable, protected ?string $configurator = null)
    {
    }

    public static function for(ThrowableInterface $throwable, ?string $configurator = null): static
    {
        return static::create($throwable, $configurator);
    }

    public static function use(string $default): void
    {
        static::$default = $default;
    }

    public static function default(): string
    {
        return static::$default ??= 'configure';
    }

    public function throwable(): ThrowableInterface
    {
        return $this->throwable;
    }

    public function configurator(): string
    {
        return $this->configurator ??= static::default();
    }

    public function forward(?string $method = null): ForwardInterface
    {
        $builder = $this->throwable() |> Forward::builder(...);

        $builder->relay($method);

        return $builder->build();
    }

    public function eval(array $arguments, ?string $method = null): ThrowableInterface
    {
        $response = $this->forward($method)->eval($this->configurator(), $arguments);

        return $this->hydrate($response, $arguments);
    }

    /**
     * @param  array<array-key, mixed>  $arguments
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
