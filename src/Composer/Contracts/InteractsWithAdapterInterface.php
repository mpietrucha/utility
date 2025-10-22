<?php

namespace Mpietrucha\Utility\Composer\Contracts;

interface InteractsWithAdapterInterface
{
    public function adapter(): AdapterInterface;
}
