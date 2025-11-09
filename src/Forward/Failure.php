<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Failure\Backtrace;
use Mpietrucha\Utility\Forward\Failure\Frames;
use Mpietrucha\Utility\Forward\Failure\Message;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;
use Mpietrucha\Utility\Type;

/**
 * @phpstan-import-type BacktraceFramesCollection from \Mpietrucha\Utility\Backtrace
 */
class Failure implements CreatableInterface, FailureInterface
{
    use Creatable;

    /**
     * Create a new failure handler for the given forward instance.
     */
    public function __construct(protected ForwardInterface $forward)
    {
    }

    /**
     * Get the forwarder instance associated with this failure handler.
     */
    public function forward(): ForwardInterface
    {
        return $this->forward;
    }

    /**
     * Process and rethrow the given throwable with enhanced metadata and messaging.
     */
    public function handle(InteractsWithThrowableInterface $throwable, string $method): void
    {
        $backtrace = $throwable->backtrace() |> $this->backtrace(...);

        $message = $this->message($throwable->value()->getMessage(), $method);

        $frame = $this->frame($backtrace);

        $throwable->synchronize($frame)->message($message)->trace($backtrace)->throw();
    }

    /**
     * Determine frame for failure line and code.
     *
     * @param  BacktraceFramesCollection  $backtrace
     */
    protected function frame(EnumerableInterface $backtrace): FrameInterface
    {
        return $backtrace->firstOrFail();
    }

    /**
     * Adjust backtrace for cleaner output.
     *
     * @param  BacktraceFramesCollection  $backtrace
     * @return BacktraceFramesCollection
     */
    protected function backtrace(EnumerableInterface $backtrace): EnumerableInterface
    {
        return match (true) {
            Backtrace::proxied($backtrace) => Frames::proxied(),
            default => Frames::unproxied()
        } |> $backtrace->skip(...);
    }

    /**
     * Format an error message by replacing the original method context with the forwarded context.
     */
    protected function message(string $message, string $method): string
    {
        [$source, $destination] = [$this->source(), $this->destination()];

        if (Type::null($source)) {
            return $message;
        }

        if (Type::null($destination)) {
            return $message;
        }

        $to = Message::get($source, $this->forward()->method() ?? $method);

        return Message::build($message, Message::get($destination, $method), $to);
    }

    /**
     * Resolve the class name of the destination in the forwarder.
     *
     * @return class-string|null
     */
    protected function destination(): ?string
    {
        return $this->forward()->destination() |> Instance::namespace(...);
    }

    /**
     * Resolve the class name of the source in the forwarder.
     *
     * @return class-string|null
     */
    protected function source(): ?string
    {
        return $this->forward()->source() |> Instance::namespace(...);
    }
}
