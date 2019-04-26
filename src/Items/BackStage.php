<?php

declare(strict_types=1);

namespace GildedRose\Items;

class BackStage extends NewItem
{
    const FIRST_BACKSTAGE_LIMIT = 11;
    const SECOND_BACKSTAGE_LIMIT = 6;
    const NAME = "Backstage passes to a TAFKAL80ETC concert";

    public function spendADay()
    {
        $item = $this->item;
        $this->increaseQualityIfNotMaximumQuality($item);
        if ($this->isBackStageInFirstDecreaseLimit($item)) {
            $this->increaseQualityIfNotMaximumQuality($item);
        }
        if ($this->isBackStageInSecondDecreaseLimit($item)) {
            $this->increaseQualityIfNotMaximumQuality($item);
        }
        $this->decreaseSellIn($item);
        if ($this->isUnderMinimumSellIn($item)) {
            $this->setMinimumQuality($item);
        }
    }

    /**
     * @param $item
     * @return bool
     */
    private function isBackStageInFirstDecreaseLimit($item)
    {
        return $item->getSellIn() < self::FIRST_BACKSTAGE_LIMIT;
    }

    /**
     * @param $item
     * @return bool
     */
    private function isBackStageInSecondDecreaseLimit($item)
    {
        return $item->getSellIn() < self::SECOND_BACKSTAGE_LIMIT;
    }
}
