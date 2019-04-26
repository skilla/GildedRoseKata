<?php

namespace GildedRose;

class GildedRose
{
    const MINIMUM_DECREASE_QUALITY = 1;
    const MINIMUM_INCREASE_QUALITY = 1;
    const MINIMUM_QUALITY = 0;
    const MAXIMUM_QUALITY = 50;
    const MINIMUM_SELL_IN = 0;
    const MINIMUM_DECREASE_SELL_IN = 1;

    public static function updateQuality($items)
    {
        foreach ($items as $key => $item) {
            $item->spendADay();
        }
    }
}
