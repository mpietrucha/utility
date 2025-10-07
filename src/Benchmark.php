<?php

namespace Mpietrucha\Utility;

abstract class Benchmark extends \Illuminate\Support\Benchmark
{
    protected static ?int $record = null;

    public static function now(): int
    {
        return hrtime(true);
    }

    public static function start(): void
    {
        static::$record = static::now();
    }

    public static function stop(?int $record = null): string
    {
        static::flush();

        $record ??= static::record();

        return static::now() - $record |> static::unit(...);
    }

    public static function halt(?int $record = null): void
    {
        static::stop($record) |> dd(...);
    }

    protected static function flush(): void
    {
        gc_collect_cycles();
    }

    protected static function unit(int $duration): string
    {
        return static::format($duration) . 'ms';
    }

    protected static function format(int $duration): float
    {
        $duration /= 1_000_000;

        return Number::format($duration, 3) |> Normalizer::float(...);
    }

    protected static function record(): int
    {
        return static::$record ?? static::now();
    }
}
