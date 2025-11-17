<?php

namespace Mpietrucha\Utility\Error\Contracts;

interface HandlerInterface
{
    /**
     * Get the underlying error handler adapter.
     */
    public function adapter(): object;

    /**
     * Determine if the handler is supported.
     */
    public function supported(): bool;

    /**
     * Capture errors using the handler.
     */
    public function capture(): void;
}
