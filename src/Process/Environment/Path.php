<?php

namespace Mpietrucha\Utility\Process\Environment;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Str;

abstract class Path extends None
{
    /**
     * @var null|\Mpietrucha\Utility\Collection<int, string>
     */
    protected static ?Collection $values = null;

    /**
     * @return \Mpietrucha\Utility\Collection<int, string>
     */
    public static function values(): Collection
    {
        return static::$values ??= Collection::create();
    }

    /**
     * @param  string|array<string, string>  $values
     */
    public static function add(array|string $values): void
    {
        static::values()->push(...) |> Collection::create($values)->pipeSpread(...);
    }

    public static function name(): string
    {
        return 'PATH';
    }

    public static function value(): string
    {
        $value = Str::explode(static::default(), $delimiter = ':');

        $values = static::values()->merge([
            '/opt/homebrew/sbin',
            '/opt/homebrew/bin',
            '/usr/local/sbin',
            '/snap/bin',
            '/usr/sbin',
            '/sbin',
        ]);

        return $value->merge($values)->unique()->join($delimiter);
    }
}
