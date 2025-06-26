<?php

namespace Mpietrucha\Utility\Stream\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;
use Psr\Http\Message\StreamInterface;

interface AdapterInterface extends StreamInterface, StringableInterface
{
    /**
     * Retrieve the underlying stream resource handled by the adapter.
     */
    public function getResource(): mixed;

    /**
     * Determine whether the adapter currently holds an attached resource.
     */
    public function isAttached(): bool;

    /**
     * Determine whether the adapter’s resource has been detached.
     */
    public function isDetached(): bool;

    /**
     * Get the stream’s URI if the resource is attached, otherwise null.
     */
    public function getUri(): ?string;

    /**
     * Get the file path represented by the stream, or null if it is not a file
     * or the file no longer exists.
     */
    public function getFile(): ?string;
}
