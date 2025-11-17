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
     * Get the synchronizer configuration as an array.
     *
     * @return array{0: \Mpietrucha\Utility\Throwable\Property}
     */
    public function toArray(): array;

    /**
     * Build the property and value tuple from the given frame.
     *
     * @return array{0: \Mpietrucha\Utility\Throwable\Property, 1: mixed}
     */
    public function build(FrameInterface $frame): array;

    /**
     * Get the throwable property being synchronized.
     */
    public function property(): Property;

    /**
     * Get the value to synchronize from the given frame.
     */
    public function value(FrameInterface $frame): mixed;

    /**
     * Determine if the synchronizer value exists in the given frame.
     *
     * @phpstan-assert-if-true false $this->unexists()
     *
     * @phpstan-assert-if-false true $this->unexists()
     */
    public function exists(FrameInterface $frame): bool;

    /**
     * Determine if the synchronizer value does not exist in the given frame.
     *
     * @phpstan-assert-if-true false $this->exists()
     *
     * @phpstan-assert-if-false true $this->exists()
     */
    public function unexists(FrameInterface $frame): bool;
}
