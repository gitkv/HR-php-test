<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum implements LocalizedEnum
{
    const NEW = 0;
    const SUCCESS = 10;
    const FINISH = 20;
}
