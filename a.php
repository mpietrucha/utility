<?php

require_once 'vendor/autoload.php';

use Mpietrucha\Utility\Finder;

dd(
    Finder::create()->name('Value.php')->get()
);
