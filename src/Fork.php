<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Fork\Alias;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload;
use Mpietrucha\Utility\Fork\Contracts\InteractsWithAutoloadInterface;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Fork\Storage;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

abstract class Fork implements InteractsWithAutoloadInterface, UtilizableInterface
{
    /**
     * @use \Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload<string, \Mpietrucha\Utility\Fork\Contracts\TransformerInterface>
     */
    use InteractsWithAutoload, Utilizable;

    public static function use(?StorageInterface $storage = null): void
    {
        static::utilizable($storage);
    }

    /**
     * @param  array<array-key, \Mpietrucha\Utility\Fork\Contracts\TransformerInterface>  $transformers
     */
    public static function load(array $transformers): void
    {
        $transformers = Collection::create($transformers)->whereInstance(TransformerInterface::class);

        /** @phpstan-ignore-next-line expr.resultUnused */
        static::add(...) |> $transformers->each(...);
    }

    public static function add(TransformerInterface $transformer): void
    {
        static::bootstrap();

        Alias::transformer($transformer);

        static::autoload()->put($transformer->namespace(), $transformer);
    }

    protected static function require(string $fork): void
    {
        $transformer = static::autoload()->get($fork);

        if (Type::null($transformer)) {
            return;
        }

        if ($transformer->file() |> Filesystem::unexists(...)) {
            return;
        }

        static::storage()->store($transformer) |> Filesystem::requireOnce(...);
    }

    protected static function storage(): StorageInterface
    {
        return static::utilize();
    }

    protected static function hydrate(): StorageInterface
    {
        return Storage::create();
    }
}
