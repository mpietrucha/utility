<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;
use Mpietrucha\Utility\Finder\Contracts\LoopInterface;
use Mpietrucha\Utility\Type;

abstract class Loop implements LoopInterface
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\LazyCollection<string, \Mpietrucha\Utility\Finder\Result>
     */
    public static function run(AdapterInterface $adapter, ?string $input, ?int $limit, ?int $deepness): LazyCollection
    {
        $handler = static::fresh($adapter);

        $response = LazyCollection::empty();

        while (true) {
            if (static::exceeded($input, $deepness)) {
                break;
            }

            $builder = static::fresh($handler);

            $builder->in($input);

            $response = LazyCollection::create($builder)->merge($response);

            if (static::fulfilled($response, $limit)) {
                break;
            }

            $directory = Path::name($input);

            [$handler, $input, $deepness] = static::next($adapter, $input, $deepness);

            $adapter->exclude($directory);
        }

        return $response->map(Result::create(...));
    }

    protected static function fresh(AdapterInterface $adapter): AdapterInterface
    {
        return clone $adapter;
    }

    /**
     * @phpstan-assert-if-false string $input
     */
    protected static function exceeded(?string $input, ?int $deepness): bool
    {
        if (Type::null($input)) {
            return true;
        }

        if ($input === Path::root($input)) {
            return true;
        }

        return Type::integer($deepness) && $deepness <= 1;
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\LazyCollection<string, \Mpietrucha\Utility\Finder\Result>  $response
     */
    protected static function fulfilled(LazyCollection $response, ?int $limit): bool
    {
        $target ??= 1;

        return $response->count() >= $target;
    }

    /**
     * @return array{0: \Mpietrucha\Utility\Finder\Contracts\AdapterInterface, 1: string, 2: int|null}
     */
    protected static function next(AdapterInterface $adapter, string $input, ?int $deepness): array
    {
        $input = Path::directory($input);

        Type::integer($deepness) && $deepness--;

        return [static::fresh($adapter), $input, $deepness];
    }
}
