<?php

use Mpietrucha\Utility\Fork;

Fork::create()->load([
    \Mpietrucha\Fork\Stream::create(),
    \Mpietrucha\Fork\HigherOrderCollectionProxyHelper::create(),
]);
