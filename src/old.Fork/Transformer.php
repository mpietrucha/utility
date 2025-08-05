<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;

abstract class Transformer implements CreatableInterface, TransformerInterface
{
    use Creatable;

    public function content(string $content): ContentInterface
    {
        $content = Content::create($content);

        $content->change(
            Str::sprintf('namespace %s;', $this->class()),
            Str::sprintf('namespace %s;', $this->namespace()),
        );

        return $content;
    }

    public function storage(): StorageInterface
    {
        return Storage::create($this);
    }

    public function namespace(): string
    {
        return $this->prefix() . '\\' . $this->class();
    }

    public function prefix(): ?string
    {
        return 'Fork';
    }
}
