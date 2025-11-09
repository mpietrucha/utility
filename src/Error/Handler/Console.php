<?php

namespace Mpietrucha\Utility\Error\Handler;

use Mpietrucha\Utility\Error\Context;
use NunoMaduro\Collision\Provider;

class Console extends None
{
    /**
     * Get the Collision provider adapter for console error handling.
     */
    public function adapter(): Provider
    {
        return new Provider;
    }

    /**
     * Determine if this handler is supported in the current context.
     */
    public function supported(): bool
    {
        return Context::console();
    }

    /**
     * Register the error handler to capture errors.
     */
    public function capture(): void
    {
        $this->adapter()->register();
    }
}
