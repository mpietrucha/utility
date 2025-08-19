<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    /**
     * @return array{0: object|string, 1: object|string|null, 2: string|null, 3: \Mpietrucha\Utility\Forward\Contracts\FailureInterface|null, 4: \Mpietrucha\Utility\Forward\Contracts\EvaluableInterface|null}
     */
    public function toArray(): array;

    /**
     * Build and return a fully configured Forward instance
     * based on the current builder configuration.
     */
    public function build(): ForwardInterface;
}
