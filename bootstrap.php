<?php

use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Dependency;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Fork;

Dependency::bootstrap();

Benchmark::start();

Ephemeral::validate();

Fork::load([
    Path::get('overrides/Nyholm/Psr7/Stream.php'),
    Path::get('overrides/Illuminate/Process/Pipe.php'),
    Path::get('overrides/Larastan/Support/HigherOrderCollectionProxyHelper.php'),
    Path::get('overrides/Larastan/Methods/HigherOrderCollectionProxyExtension.php'),
    Path::get('overrides/Larastan/Properties/HigherOrderCollectionProxyPropertyExtension.php'),
]);
