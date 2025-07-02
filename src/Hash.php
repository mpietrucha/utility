<?php

namespace Mpietrucha\Utility;

abstract class Hash
{
    public static function md5(string $input): string
    {
        return md5($input);
    }
}
