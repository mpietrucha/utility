<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Context;
use Spatie\Ignition\Ignition;

class Web extends None
{
    /**
     * Get the Ignition adapter for web error handling.
     */
    public function adapter(): Ignition
    {
        return Ignition::make()->setTheme('dark');
    }

    /**
     * Determine if this handler is supported in the current context.
     */
    public function supported(): bool
    {
        return Context::web();
    }

    /**
     * Register the error handler to capture errors.
     */
    public function capture(): void
    {
        $this->adapter()->register();
    }
}
