<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Throwable\Property;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface SynchronizerInterface extends ArrayableInterface
{
    /**
     * @return array{0: \Mpietrucha\Utility\Throwable\Property}
     */
    public function toArray(): array;

    /**
     * @return array{0: \Mpietrucha\Utility\Throwable\Property, 1: mixed}
     */
    public function build(FrameInterface $frame): array;

    public function property(): Property;

    public function value(FrameInterface $frame): mixed;

    /**
     * @phpstan-assert-if-true false $this->unexists()
     *
     * @phpstan-assert-if-false true $this->unexists()
     */
    public function exists(FrameInterface $frame): bool;

    /**
     * @phpstan-assert-if-true false $this->exists()
     *
     * @phpstan-assert-if-false true $this->exists()
     */
    public function unexists(FrameInterface $frame): bool;
}
