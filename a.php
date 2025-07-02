<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Benchmark;
use Mpietrucha\Utility\Finder;

Benchmark::dd([
    fn () => Finder::create()->name('*.ph*')->in(__DIR__)->get(),
    fn () => Finder::create()->fresh()->name('*.ph*')->in(__DIR__)->get(),
]);
