<?php

namespace Mpietrucha\Utility\Finder\Adapter;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;

class Finder extends \Symfony\Component\Finder\Finder implements AdapterInterface
{
    use Creatable;
}
