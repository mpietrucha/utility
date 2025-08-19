<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface InteractsWithSectionInterface
{
    public function line(int $line): SectionInterface;

    public function section(mixed $content): SectionInterface;
}
