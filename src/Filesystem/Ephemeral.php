<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithOutput;
use Mpietrucha\Utility\Filesystem\Contracts\InteractsWithOutputInterface;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Str;

abstract class Ephemeral implements InteractsWithOutputInterface
{
    use InteractsWithOutput;

    public static function flush(): void
    {
        $finder = static::output() |> Finder::uncached()
            ->files()
            ->in(...);

        $ephemerals = Extension::unexists(...) |> $finder->get()->filter(...);

        $ephemerals->each->delete();
    }

    public static function validate(?LotteryInterface $lottery = null): void
    {
        $lottery ??= Lottery::odds(1, 500);

        /** @phpstan-ignore-next-line */
        static::flush(...) |> $lottery->wins(...);
    }

    public static function get(?string $name = null): string
    {
        $name ??= Str::random(64);

        return @tempnam(static::output(), $name);
    }

    protected static function seed(): string
    {
        return Touch::directory('ephemerals', sys_get_temp_dir());
    }
}
