<?php

namespace Mpietrucha\Utility\Exception\Contracts;

use Mpietrucha\Utility\Backtrace\Frame;
use Throwable;

interface BuilderInterface extends InteractsWithThrowableInterface
{
    public function frame(Frame $frame): self;

    public function code(int $code): self;

    public function line(int $line): self;

    public function file(string $file): self;

    public function message(mixed $message): self;

    public function backtrace(mixed $backtrace): self;

    public function previous(?Throwable $previous): self;
}
