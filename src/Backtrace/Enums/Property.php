<?php

namespace Mpietrucha\Utility\Backtrace\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case File = 'file';

    case Line = 'line';

    case Type = 'type';

    case Arguments = 'args';

    case Namespace = 'class';

    case Instance = 'object';

    case Function = 'function';
}
