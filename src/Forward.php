<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Forward\Builder;
use Mpietrucha\Utility\Forward\Contracts\BuilderInterface;
use Mpietrucha\Utility\Forward\Contracts\EvaluableInterface;
use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\MethodsInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Forward\Evaluable;
use Mpietrucha\Utility\Forward\Failure;
use Mpietrucha\Utility\Forward\Proxy;
use Mpietrucha\Utility\Value\Contracts\ResultInterface;

/**
 * Create a new instance for the destination, with optional source, default method, failure handler, and evaluable wrapper.
 *
 * @property class-string|object $destination
 * @property class-string|object|null $source
 */
class Forward implements ForwardInterface, WrappableInterface
{
    use Wrappable;

    /**
     * @var class-string
     */
    protected static string $wrappable = ForwardInterface::class;

    /**
     * Create a new forward instance for method delegation.
     *
     * @param  class-string|object  $destination
     * @param  class-string|object|null  $source
     */
    public function __construct(
        protected object|string $destination,
        protected null|object|string $source = null,
        protected ?string $method = null,
        protected ?FailureInterface $failure = null,
        protected ?EvaluableInterface $evaluable = null,
    ) {
    }

    /**
     * Create a new forward builder for the given destination.
     */
    public static function builder(object|string $destination): BuilderInterface
    {
        return Builder::create($destination);
    }

    /**
     * Get the source class or object, defaulting to the destination when none was provided.
     *
     * @return class-string|object
     */
    public function source(): object|string
    {
        return $this->source ??= $this->destination();
    }

    /**
     * Get the destination class or object that method calls will be forwarded to.
     *
     * @return class-string|object
     */
    public function destination(): object|string
    {
        return $this->destination;
    }

    /**
     * Get the preset method name (if any) that will be invoked on forwarding.
     */
    public function method(): ?string
    {
        return $this->method;
    }

    /**
     * Build a dynamic proxy that forwards allowed method calls to the destination.
     */
    public function proxy(?MethodsInterface $methods = null): ProxyInterface
    {
        return Proxy::create($this, $methods);
    }

    /**
     * Retrieve (or create) the failure handler responsible for processing call exceptions.
     */
    public function failure(): FailureInterface
    {
        return $this->failure ??= Failure::create($this);
    }

    /**
     * Retrieve (or create) the evaluable callback used to invoke destination methods.
     */
    public function evaluable(): EvaluableInterface
    {
        return $this->evaluable ??= $this->destination() |> Evaluable::create(...);
    }

    /**
     * Invoke the given method on the destination, throwing via the failure handler on error, and return the result.
     */
    public function get(string $method, mixed ...$arguments): mixed
    {
        return $this->eval($method, $arguments);
    }

    /**
     * Safely invoke the given method, returning a Result that captures either the value or the thrown exception.
     */
    public function attempt(string $method, array $arguments): ResultInterface
    {
        $evaluable = $this->evaluable();

        return Value::attempt($evaluable)->get($method, $arguments);
    }

    /**
     * Invoke the given method, throw via the failure handler on error, and return the successful value.
     */
    public function eval(string $method, array $arguments): mixed
    {
        $result = $this->attempt($method, $arguments);

        $this->fail($result, $method);

        return $result->value();
    }

    /**
     * Guess the arguments to forward by skipping source parameters.
     */
    public function guess(string $method, array $arguments, callable $source): mixed
    {
        $parameters = Reflection::callable($source)->getNumberOfParameters();

        $arguments = Arr::skip($arguments, $parameters);

        return $this->eval($method, $arguments);
    }

    /**
     * Compose the method call by prepending an argument to the arguments array.
     */
    public function compose(string $method, mixed $argument, array $arguments): mixed
    {
        $arguments = Arr::prepend($arguments, $argument);

        return $this->eval($method, $arguments);
    }

    /**
     * Pass a failed Result to the failure handler for processing.
     */
    protected function fail(ResultInterface $result, string $method): void
    {
        if ($result->succeeded()) {
            return;
        }

        $this->failure()->handle($result->throwable(), $method);
    }
}
