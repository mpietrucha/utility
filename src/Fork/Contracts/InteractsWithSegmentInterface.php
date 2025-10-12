<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface InteractsWithSegmentInterface
{
    public function line(int $line): SegmentInterface;

    public function segment(mixed $segment): SegmentInterface;
}
