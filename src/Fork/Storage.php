<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Fork\Instance\File;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

class Storage implements CreatableInterface, StorageInterface
{
    use Creatable, Utilizable\Strings;

    /**
     * Create a new storage instance with optional custom directory and lottery.
     */
    public function __construct(protected ?string $directory = null, protected ?LotteryInterface $lottery = null)
    {
    }

    /**
     * Validate the storage by occasionally flushing based on lottery odds.
     */
    public function validate(): void
    {
        $this->flush(...) |> $this->lottery()->wins(...);
    }

    /**
     * Flush all cached forked files from the storage directory.
     */
    public function flush(): void
    {
        $this->directory() |> Temporary::flush(...);
    }

    /**
     * Generate a unique identity hash for the transformer.
     */
    public function identify(TransformerInterface $transformer): string
    {
        $file = $transformer->file();

        $transformer = File::get($transformer);

        return Filesystem::hash($file) . Filesystem::hash($file) |> Hash::md5(...);
    }

    /**
     * Store the transformed class file and return the storage path.
     */
    public function store(TransformerInterface $transformer): string
    {
        $file = $this->identify($transformer) |> $this->file(...);

        if (Filesystem::exists($file)) {
            return $file;
        }

        Filesystem::put($file, $this->transform($transformer));

        return $file;
    }

    /**
     * Transform the class content and return the transformed string.
     */
    public function transform(TransformerInterface $transformer): string
    {
        $content = $transformer->file() |> Filesystem::get(...) |> $transformer->content(...);

        $transformer->transform($content);

        return $content->toString();
    }

    /**
     * Get the storage file path for the given identity.
     */
    protected function file(string $identity): string
    {
        return Temporary::get($identity, $this->directory());
    }

    /**
     * Get the storage directory path.
     */
    protected function directory(): string
    {
        return $this->directory ??= static::utilize();
    }

    /**
     * Get the lottery instance for probabilistic cache flushing.
     */
    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    /**
     * Create a temporary directory for fork storage.
     */
    protected static function hydrate(): string
    {
        return Temporary::directory('forks');
    }
}
