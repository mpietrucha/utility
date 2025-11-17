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
    Path::cwd('overrides/Nyholm/Psr7/Stream.php'),
    Path::cwd('overrides/Illuminate/Process/Pipe.php'),
    Path::cwd('overrides/Larastan/Support/HigherOrderCollectionProxyHelper.php'),
    Path::cwd('overrides/Larastan/Methods/HigherOrderCollectionProxyExtension.php'),
    Path::cwd('overrides/Larastan/Properties/HigherOrderCollectionProxyPropertyExtension.php'),
]);
