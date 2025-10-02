<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Context;
use NunoMaduro\Collision\Provider;

class Console extends None
{
    public function adapter(): Provider
    {
        return new Provider;
    }

    public function supported(): bool
    {
        return Context::console();
    }

    public function capture(): void
    {
        $this->adapter()->register();
    }
}
