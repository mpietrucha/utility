<?php

use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Dependency;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Fork;

Dependency::bootstrap();

Benchmark::start();

Ephemeral::validate();

Fork::load([
    'overrides/Nyholm/Psr7/Stream.php',
    'overrides/Illuminate/Process/Pipe.php',
    'overrides/Larastan/Support/HigherOrderCollectionProxyHelper.php',
    'overrides/Larastan/Methods/HigherOrderCollectionProxyExtension.php',
    'overrides/Larastan/Properties/HigherOrderCollectionProxyPropertyExtension.php',
]);
