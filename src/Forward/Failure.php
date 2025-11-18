<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Forward\Contracts\ProxyInterface;
use Mpietrucha\Utility\Forward\Exception\FailureFrameException;
use Mpietrucha\Utility\Forward\Failure\Backtrace;
use Mpietrucha\Utility\Forward\Failure\Message;
use Mpietrucha\Utility\Throwable\Contracts\InteractsWithThrowableInterface;

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
        $backtrace = $this->backtrace($throwable);

        $this->frame($backtrace, $throwable) |> $throwable->synchronize(...);

        $backtrace->all() |> $throwable->trace(...);

        $this->message($throwable, $method) |> $throwable->message(...);

        $throwable->throw();
    }

    /**
     * Adjust the backtrace by skipping internal frames for cleaner output.
     *
     * @return BacktraceFramesCollection
     */
    protected function backtrace(InteractsWithThrowableInterface $throwable): EnumerableInterface
    {
        $backtrace = $throwable->backtrace();

        return $backtrace->pipeThrough([
            fn (EnumerableInterface $backtrace) => $this->forward() |> $backtrace->skipUntilLast->internal(...),
            fn (EnumerableInterface $backtrace) => $backtrace->skipWhile->internal(ProxyInterface::class),
        ]);
    }

    /**
     * Determine the frame for failure line and code from the backtrace.
     *
     * @param  BacktraceFramesCollection  $backtrace
     */
    protected function frame(EnumerableInterface $backtrace, InteractsWithThrowableInterface $throwable): FrameInterface
    {
        if ($backtrace->isNotEmpty()) {
            return $backtrace->firstOrFail();
        }

        return $throwable->backtrace()->last() ?? FailureFrameException::create()->throw();
    }

    /**
     * Format an error message by replacing the original method context with the forwarded context.
     */
    protected function message(InteractsWithThrowableInterface $throwable, string $method): string
    {
        $message = $throwable->value()->getMessage();

        $to = Message::to($this, $method);

        return Message::build($message, Message::from($this, $method), $to);
    }
}
