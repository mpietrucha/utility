<?php

namespace Mpietrucha\Utility\Filesystem\Concerns;

trait InteractsWithOutput
{
    protected static ?string $output = null;

    public static function use(string $output): void
    {
        static::$output = $output;
    }

    public static function output(): string
    {
        return static::$output ??= static::seed();
    }

    abstract protected static function seed(): string;
}
