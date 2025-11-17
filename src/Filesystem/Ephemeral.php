<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Ephemeral implements UtilizableInterface
{
    use Utilizable\Strings;

    /**
     * Flush all ephemeral files from the ephemeral directory.
     */
    public static function flush(): void
    {
        static::utilize() |> Temporary::flush(...);
    }

    /**
     * Validate and potentially flush ephemeral files based on lottery odds.
     */
    public static function validate(?LotteryInterface $lottery = null): void
    {
        $lottery ??= Lottery::odds(1, 500);

        static::flush(...) |> $lottery->wins(...);
    }

    /**
     * Get a unique ephemeral file path.
     */
    public static function get(?string $name = null): string
    {
        $directory = static::utilize();

        return Temporary::file($name, $directory, Temporary::UNIQUE);
    }

    /**
     * Hydrate and return the ephemeral directory path.
     */
    protected static function hydrate(): string
    {
        return Temporary::directory('ephemerals');
    }
}
