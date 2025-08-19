<?php

namespace Mpietrucha\Utility\Lottery;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Adapter extends \Illuminate\Support\Lottery implements CreatableInterface
{
    use Creatable;
}
