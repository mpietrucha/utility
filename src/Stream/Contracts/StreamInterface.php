<?php

namespace Mpietrucha\Utility\Stream\Contracts;

interface StreamInterface
{
    public function adapter(): AdapterInterface;

    public function resource(): mixed;

    public function attached(): bool;

    public function detached(): bool;

    public function uri(): ?string;

    public function file(): ?string;

    public function await(bool $mode = true): StreamInterface;

    public function unleash(bool $mode = true): StreamInterface;

    public function close(): void;

    public function detach(): mixed;

    public function size(): ?int;

    public function tell(): int;

    public function eof(): bool;

    public function seekable(): bool;

    public function seek(int $pointer, int $mode = SEEK_SET): StreamInterface;

    public function rewind(): StreamInterface;

    public function restore(?int $pointer = null, int $mode = SEEK_SET): StreamInterface;

    public function writable(): bool;

    public function copy(StreamInterface $source): StreamInterface;

    public function paste(StreamInterface $destination): StreamInterface;

    public function write(StreamInterface|string $contents): StreamInterface;

    public function set(StreamInterface|string $contents): StreamInterface;

    public function bytes(): ?int;

    public function readable(): bool;

    public function read(int $length): string;

    public function contents(): string;

    public function get(): string;
}
