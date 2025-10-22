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

    public static function find(string $class): string
    {
        return File::get($class);
    }

    public static function join(string $namespace, string $class): string
    {
        return Path::join($namespace, $class);
    }

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

    public function file(): string
    {
        return $this->file ??= $this->class() |> static::find(...);
    }

    public function prefix(): string
    {
        return 'Fork';
    }

    public function namespace(): string
    {
        return static::join($this->prefix(), $this->class());
    }

    public function content(string $content): ContentInterface
    {
        return static::hydrate(Content::create($content), $this);
    }
}
