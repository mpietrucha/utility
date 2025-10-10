<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Ephemeral implements UtilizableInterface
{
    use Utilizable\Strings;

    public static function flush(): void
    {
        static::utilize() |> Temporary::flush(...);
    }

    public static function validate(?LotteryInterface $lottery = null): void
    {
        $lottery ??= Lottery::odds(1, 500);

        /** @phpstan-ignore-next-line */
        static::flush(...) |> $lottery->wins(...);
    }

    public static function get(?string $name = null): string
    {
        $directory = static::utilize();

        return Temporary::file($name, $directory, Temporary::UNIQUE);
    }

    protected static function hydrate(): string
    {
        return Temporary::directory('ephemerals');
    }
}
