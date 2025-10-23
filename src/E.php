<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Throwable\RuntimeException;

class E extends RuntimeException
{
    public function __construct()
    {
        $this->message('cwel');
    }
}
