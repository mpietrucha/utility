<?php

namespace Mpietrucha\Utility\Stream\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;
use Psr\Http\Message\StreamInterface;

interface AdapterInterface extends StreamInterface, StringableInterface
{
    public function getResource(): mixed;

    public function isAttached(): bool;

    public function isDetached(): bool;

    public function getUri(): ?string;

    public function getFile(): ?string;
}
