<?php

use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Dependency;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Fork;

Dependency::bootstrap();

Benchmark::start();

Ephemeral::validate();

Fork::load([
    \Mpietrucha\Extensions\Fork\Stream::create(),
    \Mpietrucha\Extensions\Fork\Larastan\HigherOrderCollectionProxyHelper::create(),
    \Mpietrucha\Extensions\Fork\Larastan\HigherOrderCollectionProxyExtension::create(),
    \Mpietrucha\Extensions\Fork\Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
