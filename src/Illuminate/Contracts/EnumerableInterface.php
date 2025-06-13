<?php

namespace Mpietrucha\Utility\Illuminate\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;

interface EnumerableInterface extends ArrayableInterface, CreatableInterface, Enumerable, InteractsWithCollectionInterface
{
}
