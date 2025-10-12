<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload;
use Mpietrucha\Utility\Fork\Contracts\InteractsWithAutoloadInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Instance\Path;
use Mpietrucha\Utility\Type;

abstract class Alias implements InteractsWithAutoloadInterface
{
    /**
     * @use \Mpietrucha\Utility\Fork\Concerns\InteractsWithAutoload<string, string>
     */
    use InteractsWithAutoload;

    public static function transformer(TransformerInterface $transformer): void
    {
        [$class, $alias] = [$transformer->class(), $transformer->namespace()];

        static::class($class, $alias);
    }

    public static function class(string $class, string $alias): void
    {
        [$namespace, $alias] = [static::normalize($class), static::normalize($alias)];

        static::namespace($namespace, $alias);
    }

    public static function namespace(string $namespace, string $alias): void
    {
        static::bootstrap();

        static::autoload()->put($alias, $namespace);
    }

    protected static function require(string $alias): void
    {
        $namespace = static::normalize($alias) |> static::autoload()->get(...);

        if (Type::null($namespace)) {
            return;
        }

        $file = static::build($namespace, $alias);

        Type::string($file) && Filesystem::requireOnce($file);
    }

    protected static function build(string $namespace, string $alias): ?string
    {
        $name = Path::name($alias);

        return Instance::alias(Path::join($namespace, $name), $alias);
    }

    protected static function normalize(string $namespace): string
    {
        return Path::namespace($namespace);
    }
}
