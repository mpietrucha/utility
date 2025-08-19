<?php

namespace Mpietrucha\Utility\Fork\Concerns;

use Mpietrucha\Utility\Fork\Contracts\SectionInterface;
use Mpietrucha\Utility\Fork\Line;
use Mpietrucha\Utility\Fork\Section;

trait InteractsWithSection
{
    public function line(int $line): SectionInterface
    {
        return Line::create($this, $line);
    }

    public function section(mixed $content): SectionInterface
    {
        return Section::build($this, $content);
    }
}
