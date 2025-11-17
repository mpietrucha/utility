<?php

namespace Mpietrucha\Utility\Process\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Process\Adapter;

/**
 * @phpstan-type Environment array<string, string>
 *
 * @method static command(string|list<string> $command)
 * @method static path(string $path)
 * @method static timeout(int $timeout)
 * @method static idleTimeout(int $timeout)
 * @method static forever()
 * @method static env(Environment $environment)
 * @method static input(\Traversable<mixed>|resource|string|int|float|bool|null $input)
 * @method static quietly()
 * @method static tty(bool $tty = true)
 * @method static options(array<string, bool> $options)
 * @method static run(null|string|list<string> $command = null, callable|null $output = null)
 * @method static start(null|string|list<string> $command = null, callable|null $output = null)
 * @method bool supportsTty()
 * @method \Illuminate\Process\Pool pool(callable $callback)
 * @method \Illuminate\Contracts\Process\ProcessResult pipe(callable|list<string> $callback, callable|null $output = null)
 * @method \Illuminate\Process\ProcessPoolResults concurrently(callable $callback, callable|null $output = null)
 */
interface ProcessInterface extends CreatableInterface
{
    /**
     * Get the process adapter instance.
     */
    public static function adapter(): Adapter;
}
