<?php

namespace Mpietrucha\Utility\Fork\Concerns;

use Mpietrucha\Utility\Collection;

/**
 * @template TKey of array-key
 *
 * @template-covariant TValue
 *
 * @internal
 *
 * @phpstan-require-implements \Mpietrucha\Utility\Fork\Contracts\InteractsWithAutoloadInterface
 */
trait InteractsWithAutoload
{
    /**
     * @var \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    protected static ?Collection $autoload = null;

    public static function bootstrap(): void
    {
        static::autoload()->isEmpty() && static::require(...) |> spl_autoload_register(...);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<TKey, TValue>
     */
    protected static function autoload(): Collection
    {
        return static::$autoload ??= Collection::create();
    }

    abstract protected static function require(string $class): void;
}
