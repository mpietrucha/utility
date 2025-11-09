<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Finder\Contracts\ReflectionInterface;
use Mpietrucha\Utility\Type;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @extends \Mpietrucha\Utility\Reflection<\Symfony\Component\Finder\Finder>
 */
class Reflection extends \Mpietrucha\Utility\Reflection implements ReflectionInterface
{
    /**
     * @var array<string, mixed>
     */
    protected static array $defaults = [
        'dirs' => [],
    ];

    /**
     * @var \Mpietrucha\Utility\Collection<string, mixed>
     */
    protected static ?Collection $properties = null;

    /**
     * Create a new reflection wrapper for the Symfony Finder adapter.
     */
    public function __construct(protected Adapter $adapter)
    {
        parent::__construct($adapter);
    }

    /**
     * Refresh the adapter by resetting all properties to their defaults.
     */
    public static function refresh(?Adapter $adapter): void
    {
        if (Type::null($adapter)) {
            return;
        }

        static::create($adapter)->reset(...) |> static::properties()->keys()->each(...);
    }

    /**
     * Reset a specific property on the adapter to its default value.
     */
    public function reset(string $property): void
    {
        $value = static::properties()->get($property);

        if (Type::null($value)) {
            return;
        }

        $this->getProperty($property)->setValue($this->adapter(), $value);
    }

    /**
     * Get the underlying Symfony Finder adapter instance.
     */
    protected function adapter(): Adapter
    {
        return $this->adapter;
    }

    /**
     * Get the collection of property defaults.
     *
     * @return \Mpietrucha\Utility\Collection<string, mixed>
     */
    protected static function properties(): Collection
    {
        return static::$properties ??= static::defaults() |> Collection::create(...);
    }

    /**
     * Get the default property values for the Finder adapter.
     *
     * @return array<string, mixed>
     */
    protected static function defaults(): array
    {
        return static::$defaults;
    }
}
