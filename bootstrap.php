<?php

use Mpietrucha\Extensions\Fork\Larastan;
use Mpietrucha\Extensions\Fork\Stream;
use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Dependency;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Fork;

Dependency::bootstrap();

Benchmark::start();

Ephemeral::validate();

Fork::load([
    Stream::create(),
    Larastan\HigherOrderCollectionProxyHelper::create(),
    Larastan\HigherOrderCollectionProxyExtension::create(),
    Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
