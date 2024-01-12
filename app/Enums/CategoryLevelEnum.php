<?php declare(strict_types=1);

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryLevelEnum extends Enum
{
    const Fisrt = 1;
    const Second = 2;
    const Third = 3;
}
