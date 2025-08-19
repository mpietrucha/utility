<?php

namespace Mpietrucha\Utility\Finder\Imprint;

class Timestamp extends None
{
    public function get(string $input): string
    {
        return $input;
    }

    public function expired(string $input): bool
    {
        return false;
    }
}
