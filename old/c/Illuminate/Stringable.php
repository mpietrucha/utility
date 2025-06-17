<?php

namespace Mpietrucha\Utility\Illuminate;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Stringable extends \Illuminate\Support\Stringable implements CreatableInterface
{
    use Creatable;
}
