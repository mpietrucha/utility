<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface InteractsWithAutoloadInterface
{
    /**
     * Bootstrap the autoloader.
     */
    public static function bootstrap(): void;
}
