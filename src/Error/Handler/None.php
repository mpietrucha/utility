<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Error\Contracts\HandlerInterface;

abstract class None implements CreatableInterface, HandlerInterface
{
    use Creatable;
}
