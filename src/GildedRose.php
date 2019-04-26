<?php

namespace GildedRose;

class GildedRose
{
    public static function updateQuality($items)
    {
        foreach ($items as $key => $item) {
            $item->spendADay();
        }
    }
}
