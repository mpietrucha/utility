<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Fork\Instance\File;
use Mpietrucha\Utility\Fork\Transformer\Normalizer;
use Mpietrucha\Utility\Instance\Path;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Creatable;

    protected ?string $file = null;

    /**
     * Find the file path for the given class.
     */
    public static function find(string $class): string
    {
        return File::get($class);
    }

    /**
     * Join a namespace prefix with a class name.
     */
    public static function join(string $namespace, string $class): string
    {
        return Path::join($namespace, $class);
    }

    /**
     * Hydrate content by replacing class and namespace references with transformed versions.
     */
    public static function hydrate(ContentInterface $content, TransformerInterface $transformer): ContentInterface
    {
        $content->replace(
            $transformer->class() |> Normalizer::name(...),
            $transformer->namespace() |> Normalizer::name(...)
        );

        return $content->replace(
            $transformer->class() |> Normalizer::namespace(...),
            $transformer->namespace() |> Normalizer::namespace(...),
        );
    }

    /**
     * Get the source file path for the class being transformed.
     */
    public function file(): string
    {
        return $this->file ??= $this->class() |> static::find(...);
    }

    /**
     * Get the namespace prefix for forked classes.
     */
    public function prefix(): string
    {
        return 'Fork';
    }

    /**
     * Get the transformed namespace for the forked class.
     */
    public function namespace(): string
    {
        return static::join($this->prefix(), $this->class());
    }

    /**
     * Create a content instance with the given content string and apply transformations.
     */
    public function content(string $content): ContentInterface
    {
        return static::hydrate(Content::create($content), $this);
    }
}
