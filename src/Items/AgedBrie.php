<?php

declare(strict_types=1);

namespace GildedRose\Items;

class AgedBrie extends NewItem
{
    const NAME = "Aged Brie";

    public function spendADay(): void
    {
        $item = $this->item;
        $this->increaseQualityIfNotMaximumQuality($item);
        $this->decreaseSellIn($item);
        if ($this->isUnderMinimumSellIn($item)) {
            $this->increaseQualityIfNotMaximumQuality($item);
        }
    }
}
