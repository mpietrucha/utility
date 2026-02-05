<?php

namespace Mpietrucha\Utility\Reflection;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection;
use Mpietrucha\Utility\Reflection\Contracts\ReflectionInterface;
use Mpietrucha\Utility\Reflection\Exception\ReplicatorInputException;
use Mpietrucha\Utility\Reflection\Exception\ReplicatorReflectionException;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 *
 * @phpstan-type PropertyCollection \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, mixed>
 */
class Replicator implements CreatableInterface
{
    use Creatable;

    /**
     * @var PropertyCollection|null
     */
    protected ?EnumerableInterface $properties = null;

    public function __construct(protected object $input, protected ?ReflectionInterface $reflection = null)
    {
        if (Type::null($reflection)) {
            return;
        }

        if ($reflection->isInstance($input)) {
            return;
        }

        ReplicatorReflectionException::create()->throw();
    }

    /**
     * @param  MixedArray|null  $arguments
     */
    public static function build(object|string $input, ?array $arguments = null): static
    {
        Instance::unexists($input) && ReplicatorInputException::create()->throw();

        if (Type::object($input)) {
            return static::create($input);
        }

        $reflection = Reflection::create($input);

        $input = Normalizer::array($arguments) |> $reflection->newInstanceArgs(...);

        return static::create($input, $reflection);
    }

    public function input(): object
    {
        return $this->input;
    }

    public function reflection(): ReflectionInterface
    {
        return $this->reflection ??= $this->input() |> Reflection::create(...);
    }

    /**
     * @return PropertyCollection
     */
    public function properties(): EnumerableInterface
    {
        $properties = $this->properties |> Collection::wrap(...);

        if ($properties->isNotEmpty()) {
            return $properties;
        }

        return $this->properties = $properties->pipeThrough([
            fn (EnumerableInterface $properties) => $this->reflection()->getProperties() |> $properties->merge(...),
            fn (EnumerableInterface $properties) => $properties->keyBy->getName(),
            fn (EnumerableInterface $properties) => $this->input() |> $properties->map->getValue(...),
        ]);
    }

    /**
     * @param  MixedArray|null  $arguments
     */
    public function replicate(object|string $destination, ?array $arguments = null): object
    {
        $destination = static::build($destination, $arguments);

        $destination->assign(...) |> $this->properties()->each(...);

        return $destination->input();
    }

    protected function assign(mixed $value, string $property): void
    {
        if ($this->reflection()->doesntHaveProperty($property)) {
            return;
        }

        $input = $this->input();

        $this->reflection()->getProperty($property)->setValue($input, $value);
    }
}
