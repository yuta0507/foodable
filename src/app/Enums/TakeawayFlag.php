<?php

namespace App\Enums;

enum TakeawayFlag: int
{
    case Missing = 0;
    case Impossible = 1;
    case Possible = 2;

    /**
     * For view labels
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::Missing => "I don't know",
            self::Impossible => 'Impossible',
            self::Possible => 'Possible',
        };
    }
}
