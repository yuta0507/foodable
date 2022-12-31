<?php

namespace App\Enums;

enum TakeawayFlag: int
{
    case Missing = 0;
    case Impossible = 1;
    case Possible = 2;
}
