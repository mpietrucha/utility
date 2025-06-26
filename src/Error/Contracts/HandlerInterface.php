<?php

namespace Mpietrucha\Utility\Error\Contracts;

interface HandlerInterface
{
    /**
     * Register the error handler.
     */
    public static function register(): void;
}
