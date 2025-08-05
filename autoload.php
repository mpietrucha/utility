<?php

use Mpietrucha\Utility\Fork\Bucket;

Bucket::create([
    \Mpietrucha\Fork\Stream::create(),
    \Mpietrucha\Fork\HigherOrderCollectionProxyHelper::create(),
]);
