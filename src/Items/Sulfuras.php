<?php

declare(strict_types=1);

namespace GildedRose\Items;

class Sulfuras extends NewItem
{
    const NAME = "Sulfuras, Hand of Ragnaros";

    public function spendADay()
    {
        return new static($this->item->getQuality(), $this->item->getSellIn());
    }
}
