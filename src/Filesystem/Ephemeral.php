<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithOutput;
use Mpietrucha\Utility\Filesystem\Contracts\InteractsWithOutputInterface;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;

abstract class Ephemeral implements InteractsWithOutputInterface
{
    use InteractsWithOutput;

    public static function flush(): void
    {
        static::output() |> Temporary::flush(...);
    }

    public static function validate(?LotteryInterface $lottery = null): void
    {
        $lottery ??= Lottery::odds(1, 500);

        /** @phpstan-ignore-next-line */
        static::flush(...) |> $lottery->wins(...);
    }

    public static function get(?string $name = null): string
    {
        $directory = static::output();

        return Temporary::file($name, $directory);
    }

    protected static function seed(): string
    {
        return Touch::directory('ephemerals', Temporary::directory());
    }
}
