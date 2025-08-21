<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Concerns\Uninstanceable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithLoop;
use Mpietrucha\Utility\Finder\Contracts\LoopInterface;
use Symfony\Component\Finder\Finder as Adapter;

class Loop implements LoopInterface
{
    use InteractsWithLoop, Uninstanceable;

    final public static function run(Adapter $adapter, string $input, ?int $altitude): EnumerableInterface
    {
        $files = static::files();

        $adapter = static::adapter($adapter);

        while ($input |> static::available(...)) {
            $files = static::adapter($adapter)->in($input) |> static::files(...) |> $files->merge(...);

            if (static::finished($input, $altitude)) {
                break;
            }

            /** @var int $altitude */
            [$input, $altitude] = static::next($input, $altitude);

            $adapter->exclude($input);
        }

        return static::response($files);
    }
}
