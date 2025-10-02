<?php

namespace Mpietrucha\Utility\Forward\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    public static function destination(object|string $destination): static;

    /**
     * @return array{0: object|string, 1: object|string|null, 2: string|null, 3: \Mpietrucha\Utility\Forward\Contracts\FailureInterface|null, 4: \Mpietrucha\Utility\Forward\Contracts\EvaluableInterface|null}
     */
    public function toArray(): array;

    /**
     * Specify a default method name to be invoked by the forward.
     */
    public function method(string $method): static;

    public function relay(?string $method = null): static;

    /**
     * Specify the source class or object that the forward should appear to originate from.
     */
    public function source(object|string $source, ?string $method = null): static;

    /**
     * Attach a custom failure handler to the forward configuration.
     */
    public function failable(FailureInterface $failure): static;

    /**
     * Attach a pre-built evaluable callback to the forward configuration.
     */
    public function evaluable(EvaluableInterface $evaluable): static;

    /**
     * Build and return a fully configured Forward instance
     * based on the current builder configuration.
     */
    public function build(): ForwardInterface;
}
