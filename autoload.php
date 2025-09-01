<?php

use Mpietrucha\Utility\Fork;

Fork::create()->load([
    \Mpietrucha\Fork\Stream::create(),
    \Mpietrucha\Fork\Larastan\HigherOrderCollectionProxyHelper::create(),
    \Mpietrucha\Fork\Larastan\HigherOrderCollectionProxyExtension::create(),
    \Mpietrucha\Fork\Larastan\HigherOrderCollectionProxyPropertyExtension::create(),
]);
