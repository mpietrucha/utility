<?php

namespace Mpietrucha\Utility\Error\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case Type = 'type';

    case Message = 'message';

    case File = 'file';

    case Line = 'line';
}
