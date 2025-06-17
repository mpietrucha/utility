<?php

namespace Mpietrucha\Utility\Backtrace\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Illuminate\Collection;

interface FrameInterface extends ArrayableInterface
{
    public function file(): string;

    public function line(): int;

    public function type(): string;

    public function arguments(): Collection;

    public function namespace(): string;

    public function instance(): ?object;

    public function function(): string;
}
