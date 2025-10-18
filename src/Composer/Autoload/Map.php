<?php

namespace Mpietrucha\Utility\Composer\Autoload;

use Mpietrucha\Utility\Composer\Exception\AutoloadMapException;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem;

abstract class Map
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    public static function get(string $input, ?string $cwd = null): EnumerableInterface
    {
        $input = Filesystem\Path::build($input, $cwd);

        Filesystem::unexists($input) && AutoloadMapException::for($input)->throw();

        $require = Filesystem::getRequire(...);

        return LazyCollection::initialize($require, $input)->remember();
    }
}
