<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Context;
use Mpietrucha\Utility\Error\Level;
use NunoMaduro\Collision\Provider;

class Console extends None
{
    public function provider(): Provider
    {
        return new Provider;
    }

    public function due(): bool
    {
        return Context::console();
    }

    public function capture(): void
    {
        $this->provider()->register();

        Level::set(Level::ALL ^ Level::DEPRECATED);
    }
}
