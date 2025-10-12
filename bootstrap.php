<?php

use Mpietrucha\Extensions\Fork\Larastan;
use Mpietrucha\Extensions\Fork\Stream;
use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Fork;

Benchmark::start();

Ephemeral::validate();

Fork::create()->load([
    Stream::create(),
    Larastan\HigherOrderCollectionProxyHelper::create(),
    Larastan\HigherOrderCollectionProxyExtension::create(),
    Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
