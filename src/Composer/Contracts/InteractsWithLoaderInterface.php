<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithLoaderInterface
{
    public function loader(): LoaderInterface;
}
