<?php

namespace Mpietrucha\Utility\Stream\Contracts;

use Mpietrucha\Utility\Forward\Contracts\ContextInterface;

interface StreamInterface extends InteractsWithFilesystemInterface
{
    /**
     * Create a stream from standard input.
     */
    public static function input(): static;

    /**
     * Create a stream from standard output.
     */
    public static function output(): static;

    /**
     * Get the underlying stream adapter instance.
     */
    public function adapter(): AdapterInterface;

    /**
     * Create a forward context that negates selected stream capabilities.
     *
     * @return \Mpietrucha\Utility\Forward\Context<static>
     */
    public function not(): ContextInterface;

    /**
     * Retrieve the raw resource managed by the stream.
     */
    public function resource(): mixed;

    /**
     * Determine whether the stream resource is currently attached.
     */
    public function attached(): bool;

    /**
     * Determine whether the stream resource has been detached.
     */
    public function detached(): bool;

    /**
     * Get the stream’s URI, or null when unavailable.
     */
    public function uri(): ?string;

    /**
     * Get the file path represented by the stream, or null if none.
     */
    public function file(): ?string;

    /**
     * Set the stream’s blocking mode and return the stream instance.
     */
    public function await(bool $mode = true): static;

    /**
     * Reverse the current blocking mode on the stream and return the instance.
     */
    public function unleash(bool $mode = true): static;

    /**
     * Close the stream resource.
     */
    public function close(): void;

    /**
     * Detach the resource from the stream and return it.
     */
    public function detach(): mixed;

    /**
     * Get the size of the stream contents, if known.
     */
    public function size(): ?int;

    /**
     * Get the current position of the stream pointer.
     */
    public function tell(): int;

    /**
     * Determine whether the end of the stream has been reached.
     */
    public function eof(): bool;

    /**
     * Determine whether the stream supports seeking.
     */
    public function seekable(): bool;

    /**
     * Move the stream pointer to the given position.
     */
    public function seek(int $pointer, int $mode = SEEK_SET): static;

    /**
     * Rewind the stream pointer to the beginning.
     */
    public function rewind(): static;

    /**
     * Restore the stream pointer to the given position or rewind it when null.
     */
    public function restore(?int $pointer = null, int $mode = SEEK_SET): static;

    /**
     * Determine whether the stream is writable.
     */
    public function writable(): bool;

    /**
     * Copy contents from the given source stream into this stream.
     */
    public function copy(StreamInterface $destination): static;

    /**
     * Transfer contents from this stream into the given destination stream.
     */
    public function paste(StreamInterface $source): static;

    /**
     * Write the given string or stream contents into this stream.
     */
    public function write(StreamInterface|string $contents): static;

    /**
     * Overwrite the stream contents with the given data, rewinding first.
     */
    public function set(StreamInterface|string $contents): static;

    /**
     * Get the number of bytes written during the last write operation.
     */
    public function bytes(): ?int;

    /**
     * Determine whether the stream is readable.
     */
    public function readable(): bool;

    /**
     * Read the specified number of bytes from the stream.
     */
    public function read(int $length): string;

    /**
     * Read the remaining contents of the stream.
     */
    public function contents(): string;

    /**
     * Get the stream contents while preserving the current pointer position.
     */
    public function get(): string;
}
