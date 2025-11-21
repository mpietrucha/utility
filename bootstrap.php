<?php

/**
 * Bootstrap the application by initializing dependencies, starting performance benchmarking,
 * validating ephemeral filesystem state, and loading fork overrides for modified library classes.
 */

use Mpietrucha\Utility\Benchmark;
use Mpietrucha\Utility\Dependency;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Fork;

Dependency::bootstrap();

Benchmark::start();

Ephemeral::validate();

Fork::load([
    Path::build('overrides/Nyholm/Psr7/Stream.php', __DIR__),
    Path::build('overrides/Illuminate/Process/Pipe.php', __DIR__),
    Path::build('overrides/Larastan/Support/HigherOrderCollectionProxyHelper.php', __DIR__),
    Path::build('overrides/Larastan/Methods/HigherOrderCollectionProxyExtension.php', __DIR__),
    Path::build('overrides/Larastan/Properties/HigherOrderCollectionProxyPropertyExtension.php', __DIR__),
]);
