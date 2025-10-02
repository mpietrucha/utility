<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Context;
use Spatie\Ignition\Ignition;

class Web extends None
{
    public function adapter(): Ignition
    {
        return Ignition::make()->setTheme('dark');
    }

    public function supported(): bool
    {
        return Context::web();
    }

    public function capture(): void
    {
        $this->adapter()->register();
    }
}
