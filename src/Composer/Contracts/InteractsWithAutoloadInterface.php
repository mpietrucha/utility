<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAutoloadInterface
{
    public function autoload(): AutoloadInterface;
}
