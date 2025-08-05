<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface LoopInterface
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\ResultInterface>
     */
    public static function run(AdapterInterface $adapter, ?string $input, ?int $limit, ?int $deepness): EnumerableInterface;
}
