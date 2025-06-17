<?php

namespace Mpietrucha\Utility\Exception\Contracts;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Throwable;

interface TransformerInterface extends CreatableInterface, InteractsWithThrowableInterface
{
    public function frame(FrameInterface $frame): TransformerInterface;

    public function code(int $code): TransformerInterface;

    public function line(int $line): TransformerInterface;

    public function file(string $file): TransformerInterface;

    public function message(mixed $message): TransformerInterface;

    public function backtrace(mixed $backtrace): TransformerInterface;

    public function previous(?Throwable $previous): TransformerInterface;
}
