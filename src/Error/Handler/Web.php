<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Context;
use Spatie\Ignition\Ignition;

class Web extends None
{
    public function provider(): Ignition
    {
        return Ignition::make()->setTheme('dark');
    }

    public function due(): bool
    {
        return Context::web();
    }

    public function capture(): void
    {
        $this->provider()->register();
    }
}
