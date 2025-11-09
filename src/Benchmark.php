<?php

namespace Mpietrucha\Utility;

abstract class Benchmark extends \Illuminate\Support\Benchmark
{
    protected static ?int $record = null;

    /**
     * Get the current high-resolution time in nanoseconds.
     */
    public static function now(): int
    {
        return hrtime(true);
    }

    /**
     * Start recording the benchmark time.
     */
    public static function start(): void
    {
        static::$record = static::now();
    }

    /**
     * Stop the benchmark and return the elapsed time formatted as a string.
     */
    public static function stop(?int $record = null): string
    {
        static::flush();

        $record ??= static::record();

        return static::now() - $record |> static::unit(...);
    }

    /**
     * Stop the benchmark and dump the elapsed time before halting execution.
     */
    public static function halt(?int $record = null): void
    {
        static::stop($record) |> dd(...);
    }

    /**
     * Force garbage collection to ensure accurate benchmark measurements.
     */
    protected static function flush(): void
    {
        gc_collect_cycles();
    }

    /**
     * Format the duration with the appropriate unit suffix.
     */
    protected static function unit(int $duration): string
    {
        return static::format($duration) . 'ms';
    }

    /**
     * Convert nanoseconds to milliseconds and format to three decimal places.
     */
    protected static function format(int $duration): float
    {
        $duration /= 1_000_000;

        return Number::format($duration, 3) |> Normalizer::float(...);
    }

    /**
     * Get the recorded start time or the current time if not set.
     */
    protected static function record(): int
    {
        return static::$record ?? static::now();
    }
}
