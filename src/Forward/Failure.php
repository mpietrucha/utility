<?php

namespace Mpietrucha\Utility\Forward;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Forward\Contracts\FailureInterface;
use Mpietrucha\Utility\Forward\Contracts\ForwardInterface;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Illuminate\Str;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Throwable\Contracts\ThrowableInterface;

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
    public function handle(ThrowableInterface $throwable, string $to): void
    {
        $backtrace = $this->backtrace($backtrace = $throwable->backtrace());

        $message = $this->message($throwable->value()->getMessage(), $to);

        $frame = $this->frame($backtrace);

        $throwable->frame($frame)->message($message)->trace($backtrace)->throw();
    }

    /**
     * Determine frame for failure line and code.
     *
     * @param  \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     */
    protected function frame(EnumerableInterface $backtrace): FrameInterface
    {
        return $backtrace->firstOrFail();
    }

    /**
     * Adjust backtrace for cleaner output.
     *
     * @param  \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>  $backtrace
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>
     */
    protected function backtrace(EnumerableInterface $backtrace): EnumerableInterface
    {
        return $backtrace->skip(10);
    }

    /**
     * Format an error message by replacing the original method context with the forwarded context.
     */
    protected function message(string $message, string $to): string
    {
        $from = Str::sprintf('%s::%s', $this->destination(), $this->forward()->method() ?? $to);

        $to = Str::sprintf('%s::%s', $this->source(), $to);

        return Str::replace($from, $to, $message);
    }

    /**
     * Resolve the class name of the destination in the forwarder.
     *
     * @return class-string|null
     */
    protected function destination(): ?string
    {
        return Instance::namespace($this->forward()->destination());
    }

    /**
     * Resolve the class name of the source in the forwarder.
     *
     * @return class-string|null
     */
    protected function source(): ?string
    {
        return Instance::namespace($this->forward()->source());
    }
}
