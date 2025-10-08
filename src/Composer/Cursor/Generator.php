<?php

namespace Mpietrucha\Utility\Composer\Cursor;

use Mpietrucha\Utility\Composer\Contracts\CursorInterface;
use Mpietrucha\Utility\Composer\Exception\CursorInputException;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Enumerable\LazyCollection;
use Mpietrucha\Utility\Filesystem;

class Generator implements CreatableInterface, CursorInterface
{
    use Creatable;

    public function get(string $input): EnumerableInterface
    {
        Filesystem::unexists($input) && CursorInputException::for($input)->throw();

        $require = Filesystem::getRequire(...);

        return LazyCollection::initialize($require, $input)->remember();
    }
}
