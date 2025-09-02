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

    public function __construct(protected Adapter $adapter)
    {
        parent::__construct($adapter);
    }

    public static function refresh(?Adapter $adapter): void
    {
        if (Type::null($adapter)) {
            return;
        }

        static::create($adapter)->reset(...) |> static::properties()->keys()->each(...);
    }

    public function reset(string $property): void
    {
        $value = static::properties()->get($property);

        if (Type::null($value)) {
            return;
        }

        $this->getProperty($property)->setValue($this->adapter(), $value);
    }

    protected function adapter(): Adapter
    {
        return $this->adapter;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, mixed>
     */
    protected static function properties(): Collection
    {
        return static::$properties ??= static::defaults() |> Collection::create(...);
    }

    /**
     * @return array<string, mixed>
     */
    protected static function defaults(): array
    {
        return static::$defaults;
    }
}
