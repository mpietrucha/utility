<?php

namespace Mpietrucha\Utility\Backtrace\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case FILE = 'file';

    case LINE = 'line';

    case TYPE = 'type';

    case ARGUMENTS = 'args';

    case NAMESPACE = 'class';

    case INSTANCE = 'object';

    case FUNCTION = 'function';
}
