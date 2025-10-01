<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Error\Contracts\HandlerInterface;

abstract class Handler
{
    /**
    * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Error\Contracts\HandlerInterface>
    */
    protected static ?Collection $handlers = null;

    public static function use(HandlerInterface $handler): void
    {
        static::all()->push($handler);
    }

    public static function flush(): void
    {
        static::$handlers = null;
    }

    public static function capture(): object
    {
        $handler = static::get();

        $handler->capture();

        return $handler;
    }

    public static function get(): HandlerInterface
    {
        return static::all()->last->due();
    }

    /**
    * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Utility\Error\Contracts\HandlerInterface>
    */
    public static function all(): Collection
    {
        return static::$handlers ??= static::defaults() |> Collection::create(...);
    }

    /**
    * @return array<int, \Mpietrucha\Utility\Error\Contracts\HandlerInterface>
    */
    protected static function defaults(): array
    {
        return [
            Handler\Web::create(),
            Handler\Console::create(),
        ];
    }
}
