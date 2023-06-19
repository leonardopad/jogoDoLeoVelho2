<?php

namespace App\Enum;

use App\Traits\OptionsEnum;

enum StatusPlayer : string
{
    use OptionsEnum;

    case Inactive = 'inactive';
    case Active   = 'active';
    case Block    = 'block';
}


