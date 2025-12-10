<?php

namespace Mpietrucha\Utility\Error\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case TYPE = 'type';

    case MESSAGE = 'message';

    case FILE = 'file';

    case LINE = 'line';
}
