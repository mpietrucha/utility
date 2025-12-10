<?php

namespace Mpietrucha\Utility\Throwable\Enums;

use Mpietrucha\Utility\Enums\Concerns\InteractsWithEnum;
use Mpietrucha\Utility\Enums\Contracts\InteractsWithEnumInterface;

enum Property: string implements InteractsWithEnumInterface
{
    use InteractsWithEnum;

    case LINE = 'line';

    case FILE = 'file';

    case CODE = 'code';

    case TRACE = 'trace';

    case MESSAGE = 'message';

    case PREVIOUS = 'previous';
}
