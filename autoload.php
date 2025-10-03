<?php

use Mpietrucha\Extensions\Fork\Larastan;
use Mpietrucha\Extensions\Fork\Stream;
use Mpietrucha\Utility\Filesystem\Ephemeral;
use Mpietrucha\Utility\Fork;

Ephemeral::flush();

Fork::create()->load([
    Stream::create(),
    Larastan\HigherOrderCollectionProxyHelper::create(),
    Larastan\HigherOrderCollectionProxyExtension::create(),
    Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
