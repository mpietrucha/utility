<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Error\Contracts\BuilderInterface;
use Mpietrucha\Utility\Error\Contracts\HandlerInterface;
use Mpietrucha\Utility\Error\Handler\Console;
use Mpietrucha\Utility\Error\Handler\Web;

abstract class Handler
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Error\Contracts\HandlerInterface>|null
     */
    protected static ?Collection $adapters = null;

    public static function builder(object $adapter): BuilderInterface
    {
        return Builder::create($adapter);
    }

    public static function add(HandlerInterface $adapter): void
    {
        static::all()->prepend($adapter);
    }

    public static function capture(?HandlerInterface $adapter = null): HandlerInterface
    {
        $adapter ??= static::get();

        $adapter->capture();

        return $adapter;
    }

    public static function get(): HandlerInterface
    {
        return static::all()->first->supported();
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Error\Contracts\HandlerInterface>
     */
    protected static function all(): Collection
    {
        return static::$adapters ??= static::defaults() |> Collection::create(...);
    }

    /**
     * @return list<\Mpietrucha\Utility\Error\Contracts\HandlerInterface>
     */
    protected static function defaults(): array
    {
        return [
            Web::create(),
            Console::create(),
        ];
    }
}
