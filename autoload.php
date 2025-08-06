<?php

use Mpietrucha\Utility\Fork\Bucket;

Bucket::create()->load([
    \Mpietrucha\Fork\Stream::create(),
    \Mpietrucha\Fork\HigherOrderCollectionProxyHelper::create(),
]);
