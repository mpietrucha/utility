<?php

use Mpietrucha\Extensions\Fork\Larastan;
use Mpietrucha\Extensions\Fork\Stream;
use Mpietrucha\Utility\Fork;

Fork::create()->load([
    Stream::create(),
    Larastan\HigherOrderCollectionProxyHelper::create(),
    Larastan\HigherOrderCollectionProxyExtension::create(),
    Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
