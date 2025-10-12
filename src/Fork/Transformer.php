<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance\Path;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Creatable;

    protected ?string $file = null;

    public static function find(string $class): string
    {
        return Instance\File::get($class);
    }

    public static function join(string $namespace, string $class): string
    {
        return Path::join($namespace, $class);
    }

    public static function hydrate(ContentInterface $content, TransformerInterface $transformer): ContentInterface
    {
        $content->replace(
            $transformer->class() |> Transformer\Normalizer::name(...),
            $transformer->namespace() |> Transformer\Normalizer::name(...)
        );

        return $content->replace(
            $transformer->class() |> Transformer\Normalizer::namespace(...),
            $transformer->namespace() |> Transformer\Normalizer::namespace(...),
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
